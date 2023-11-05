<?php
require_once('util.php');
require_once('db.php');
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
    <h1>Bienvenue sur ce site de test</h1>

    <form action="" method="GET">

        <select name="categorie" id="categorie">
            <option value="0">Toutes les catégories</option>
            <?php
            $sql = "SELECT * FROM categories ORDER BY id ASC";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            foreach ($stmt as $row) {
                echo '<option ' . (isset($_GET["categorie"]) ? ($_GET["categorie"] == $row['id'] ? 'selected' : '') : '') . ' value=' . $row['id'] . '>' . $row['nom'] . ' (' . $row['id'] . ')</option>';
            }
            ?>
        </select>
        <input type="submit" value="Filtrer">
    </form>
    <table>
        <?php
        if (isset($_GET['categorie'])) {
            $categorie = $_GET['categorie'];
            if ($categorie == 0) {
                $sql = 'SELECT * FROM articles';
            } else {
                $sql = 'SELECT * FROM articles WHERE categorie_id = ' . $categorie;
            }
        } else {
            $sql = 'SELECT * FROM articles';
        }
        $stmt = $db->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            foreach ($stmt as $row) {
                echo '<tr><td style="width: 100px;">' . $row['id'] . '</td><td style="width: 200px;">' . $row['nom'] . '</td><td style="width: 400px;">' . $row['description'] . '</td><td><a name="del"  class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Supprimer</td></tr>';
            }
        }
        ?>
    </table>

    <?php if (isset($stmt) && $stmt) {
        echo '<br><br><br><br>Requête exécutée : <br>';
        echo ($stmt->queryString);
    }
    ?>

</body>

</html>