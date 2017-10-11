<?php
function showFormAddContact($error = 0) {
    echo '<strong>Add Contact</strong><br/><br/>';
    echo '<form method="POST">';
    echo 'Name';
    echo '<input class="form-control" type="text" name="name" autofocus/>';
    echo 'Email';
    echo '<input class="form-control" type="email" name="email"/>';
    echo 'Address';
    echo '<input class="form-control" type="textarea" name="address"/>';
    echo 'Phone';
    echo '<input class="form-control" type"tel" name="phone"/><br/>';
    echo '<input class="btn btn-dark" type="submit" value="Save"/>';
    echo '</form>';
    if($error == 1) {
        echo '<p>Error inserting in database</p>';
    } elseif ($error == 2) {
        echo '<p>Field "name" cannot be blank</p>';
    }
}

function addContact($name, $email, $address, $phone) {
    require 'config.php';
    $data = array();

    $sql = "INSERT INTO contact (name, email, address, phone) VALUES ";
    $sql.="(:name, :email, :address, :phone)";

    $sql = $pdo->prepare($sql);
    $sql->bindValue(':name', $name);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':address', $address);
    $sql->bindValue(':phone', $phone);

    $sql->execute();
    
    if($pdo->lastInsertId() > 0) {
        return 0;
    } else {
        return 1;
    }
}

?>
