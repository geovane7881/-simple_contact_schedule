<?php
function showFormEditContact($contact, $error = 0) {
    echo '<strong>Edit Contact</strong><br/><br/>';
    echo '<form method="POST">';
    echo 'Name';
    echo '<input class="form-control" type="text" name="name" value="'.$contact['name'].'"/>';
    echo 'Email';
    echo '<input class="form-control" type="email" name="email" value="'.$contact['email'].'"/>';
    echo 'Address';
    echo '<input class="form-control" type="textarea" name="address" value="'.$contact['address'].'"/>';
    echo 'Phone';
    echo '<input class="form-control" type"tel" name="phone" value="'.$contact['phone'].'"/><br/>';
    echo '<input class="btn btn-dark" type="submit" value="Save"/>';
    echo '</form>';
    if($error == 1) {
        echo '<p>Error inserting in database</p>';
    } elseif ($error == 2) {
        echo '<p>Field "name" cannot be blank</p>';
    }
}

function editContact($id, $name, $email, $address, $phone) {
    require 'config.php';

    $sql = "UPDATE contact SET name = :name, email = :email, address = :address, phone = :phone ";
    $sql.=" WHERE id = :id";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':name', $name);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':address', $address);
    $sql->bindValue(':phone', $phone);

    try {
        $sql->execute();
        return 0;
    } catch(PDOException $e) {
        echo 'Error:'.$e->getMessage();
        return 1;
    }
}

?>
