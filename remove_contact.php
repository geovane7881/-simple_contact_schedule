<?php
function removeContact($id) {
    require 'config.php';
    $contact = array();

    $sql = "DELETE FROM contact WHERE id = :id";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();

    if($sql->rowCount() > 0) {
        $contact = $sql->fetch();
    }

    return $contact;
}
?>
