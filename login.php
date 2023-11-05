<?php
require_once('db.php');
require_once('util.php');
init_session_php();


try {
    if (isset($_POST['connexion'])) { //On a cliqué sur le bouton de connexion
        if (
            (isset($_POST['username']) && !empty($_POST['username'])) &&
            (isset($_POST['password']) && !empty($_POST['password']))
        ) { // Si les champs sont remplis, on vérifie les identifiants
            $escape = isset($_POST['escape']);
            $prepare = isset($_POST['prepare']);
            $username = $escape ? addslashes($_POST['username']) : $_POST['username'];
            $password = $escape ? addslashes($_POST['password']) : $_POST['password'];

            if ($prepare) {
                $sql = "SELECT * FROM utilisateurs WHERE nom = :username AND password = :password;";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                $result = $stmt;
            } else {
                $sql = "SELECT * FROM utilisateurs WHERE nom = '" . $username . "' AND password = '" . $password . "';";
                $result = $db->query($sql);
            }

            if ($result) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['nom'];
                    $_SESSION['admin'] = $row['admin'];
                    echo "Bonjour " . $_SESSION['username'] . ", vous êtes connecté ! | <a href='logout.php'> Se déconnecter </a>";
                } else {
                    echo 'Identifiants incorrects';
                }
            } else {
                echo 'Identifiants incorrects';
            }

        }
    }
} catch (PDOException $e) {
    $erreur = $e;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de test injection SQL</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' />
    <link rel='stylesheet' href='style.css' />
</head>

<body>
    <nav>

        <h1>Bienvenue sur ce site de test</h1>

        <?php if (!is_logged_in()): ?>
            <form method='POST' style="width: 300px">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Entrez votre nom d'utilisateur">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Entrez votre mot de passe" value="test">
                </div>

                <input type="submit" name="connexion" value="Se connecter"><br>
                <input type="checkbox" name="escape" value="Escape"> Utiliser escape
                <input type="checkbox" name="prepare" value="Prepare"> Utiliser prepare
            </form>
        <?php endif; ?>

        <?php if (isset($result) && $result) {
            echo '<br><br><br><br>Requête exécutée : <br>';
            echo ($result->queryString);
        }
        ?>
        <?php if (isset($erreur)) {
            echo '<br><br><br><br>' . $erreur . '<br>';
        }
        ?>

</body>

</html>