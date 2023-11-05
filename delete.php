<?php
require_once('util.php');
require_once('db.php');
init_session_php();

if (is_admin()) {
    if (isset($_GET['id'])) {
        $sql = 'DELETE FROM articles WHERE id = :id;';
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => (int) $_GET['id']]);
    }
}

header('Location: articles.php');
?>