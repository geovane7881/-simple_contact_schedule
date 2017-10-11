<?php
function showFormSearch() {
    echo '<strong>Find Contact</strong><br/><br/>';
    echo '<form method="GET">';
    echo '<input type="search" class="form-control" placeholder="contact name" name="search" autofocus/><br/>';
    echo '<input type="submit" class="btn btn-default" value="search"/>';
    echo '</form>';
}
?>
