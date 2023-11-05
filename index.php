<?php
require_once('db.php');
require_once('util.php');
init_session_php();

if (isset($_POST['connexion'])) { //Clique sur le bouton de connexion
    if (
        (isset($_POST['username']) && !empty($_POST['username'])) &&
        (isset($_POST['password']) && !empty($_POST['password']))
    ) { // Si les champs sont remplis, on vérifie les identifiants
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = 'SELECT * FROM utilisateurs WHERE nom = :username;';
        $stmt = $db->prepare($sql);
        $stmt->execute(['username' => $username]);

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $username;
                $_SESSION['admin'] = $row['admin'];
            } else {
                echo 'Identifiants incorrects';
            }
        } else {
            echo 'Identifiants incorrects';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de test CSRF</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' />
    <link rel='stylesheet' href='style.css' />
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="articles.php">Articles</a></li>
        </ul>
        <h1>Bienvenue sur ce site de test</h1>

        <?php if (is_logged_in()): ?>
            <?= $_SESSION['username'] ?> | <a href="logout.php"> Se déconnecter </a>
        <?php else: ?>
            <form method='POST'>
                <input type="text" name="username" placeholder="Entrez votre nom d'utilisateur">
                <input type="password" name="password" placeholder="Entrez votre mot de passe">
                <input type="submit" name="connexion" value="Se connecter">
            </form>
        <?php endif; ?>

</body>

</html>