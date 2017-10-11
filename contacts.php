<?php
require 'config.php';
require 'search_contact.php';
require 'add_contact.php';
require 'edit_contact.php';
require 'remove_contact.php';

function showMenu() {
    //menu add contact/edit contact
    if(isset($_GET['add_contact']) || isset($_GET['edit'])) {
        $result = 0;

        if(isset($_POST['name'])) {
            if(!empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $address = addslashes($_POST['address']);
                $phone = addslashes($_POST['phone']);
                
                //edit contact in db
                if(isset($_GET['id'])) {
                    $id = addslashes($_GET['id']);
                    $result = editContact($id, $name, $email, $address, $phone);
                //add contact to db
                } else {
                    $result = addContact($name, $email, $address, $phone);
                }

                if($result == 0) {
                    header('Location: contacts.php');
                }

            } else {
                $result = 2;
            }
        }

        //edit form
        if(isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
            showFormEditContact(getContactById($id), $result);
        //add form
        } else {
            showFormAddContact($result);
        }

    //menu search contact
    } elseif(isset($_GET['search_contact'])) {
        if(!isset($_GET['search']) || empty($_GET['search'])) {
            showFormSearch();
        }
    //remove contact
    } elseif(isset($_GET['remove'])) {
        $id = addslashes($_GET['id']);
        if(getContactById($id)) {
            removeContact($id);
            showHomeMenu();
        }
    ///menu home
    } else {
        showHomeMenu();
    }

}

//page navigation
//number of contacts per page
$contact_per_page = 2;

//get the actual page
$pg = 1;
if(isset($_GET['p']) && !empty($_GET['p'])) {
    $pg = addslashes($_GET['p']);
}
$p = ($pg - 1) * $contact_per_page;

//number of pages
function getMaxPage() {
    global $pdo;
    global $contact_per_page;

    $sql = "SELECT COUNT(*) AS num FROM contact";
    //show search results
    if(isset($_GET['search']) && !empty($_GET['search'])) {
        $search = addslashes($_GET['search']); 
        $search = '%'.$search.'%';
        $sql.= " WHERE name LIKE ?";
        $sql = $pdo->prepare($sql);
        $sql->execute(array($search));
    } else {
        $sql = $pdo->query($sql);
    }
    $sql = $sql->fetch();
    $num = intval($sql['num']);
    return ceil($num/$contact_per_page);
}

//current page content
function getContactsPerPage($page = 0) {
    global $pdo;
    global $contact_per_page;

    $sql = "SELECT * FROM contact";
    if(isset($_GET['search']) && !empty($_GET['search'])) {
        $search = addslashes($_GET['search']); 
        $search = '%'.$search.'%';
        $sql.= " WHERE name LIKE ?";
        $sql.= " LIMIT $page, $contact_per_page";
        $sql = $pdo->prepare($sql);
        $sql->execute(array($search));
    } else {
        $sql.= " LIMIT $page, $contact_per_page";
        $sql = $pdo->query($sql);
    }

    $contacts = $sql->fetchAll();

    return $contacts;
}

function getContactById($id) {
    $contact = array();
    global $pdo;
    $sql = "SELECT * FROM contact WHERE id = :id";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();

    if($sql->rowCount() > 0) {
        $contact = $sql->fetch();
    }

    return $contact;
}

function showHomeMenu() {
    echo '<strong>Menu</strong><br/><br/>';
    echo '<a href="?add_contact" class="btn btn-dark">Add Contact</a><br/><br/>';
    echo '<a href="?search_contact=true" class="btn btn-dark">Find Contact</a><br/><br/>';
}

function showContacts($contacts) {
    if(count($contacts) > 0) {
        echo '<strong>Contacts</strong><br/><br/>';
        echo '<div id="contatos">';
        echo '<table class="table borderless" width="100%">';
        foreach($contacts as $contact) {
            echo '<tr class="controls"><td colspan="2"><a href="contacts.php?remove=true&id='.$contact['id'].'"><img src="images/delete.png"></a><a href="contacts.php?edit=true&id='.$contact['id'].'"><img src="images/edit.png"/></a></td></tr>';
            echo '<tr><th>Name</th><td>'.$contact['name'].'</td></tr>';
            echo '<tr><th>Email</th><td>'.$contact['email'].'</td></tr>';
            echo '<tr><th>Phone</th><td>'.$contact['phone'].'</td></tr>';
            echo '<tr><th>Address</th> <td>'.$contact['address'].'</td></tr>';
            echo '<tr class="space"><td colspan="2"></td></tr>';
        }
        echo '</table>';
        echo '</div>'; 
    }
}
?>

<!DOCTYPE html/>
<html>
<head>
    <title>Contact Schedule</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <div class="container">
        <div class="row main-area">
            <div class="col-md-1">
            <?php if(!$p==0 && !isset($_GET['search'])):?>
                <a href="?p=<?php if($pg>1){echo $pg-$contact_per_page;}?>" class="btn btn-default btn-back"><img width="50px" src="images/back.png"/></a>
            <?php elseif(isset($_GET['search']) && $pg>1):?>
                <a href="<?php echo "?search=".$_GET['search'].'&p='.($pg-$contact_per_page);?>" class="btn btn-default btn-back"><img width="50px" src="images/back.png"/></a>
            <?php elseif(!$_GET || (isset($_GET['p']) && $_GET['p'] == 0)): ?>
                <a href="index.php" class="btn btn-default btn-back"><img width="50px" src="images/back.png"/></a>
            <?php else: ?>
                <a href="contacts.php" class="btn btn-default btn-home"><img width="50px" src="images/home.png"/></a>
            <?php endif?>
            </div>
            <div class="col-md-5 page1">
                <div class="agenda">
                    <?php
                    if(!empty($_GET['search'])) {
                        showContacts(getContactsPerPage($p));
                        $pg+=1;
                    } elseif($pg == 1 && empty($_GET['search'])) {
                        showMenu();
                    }
                    else {
                        showContacts(getContactsPerPage($p));
                    }
                    ?>
                </div>
            </div>
                <div class="controles">
                </div>
            <div class="col-md-5 page2">
                <div class="agenda">
                    <?php
                    if($pg <= getMaxPage() && !isset($_GET['edit'])){
                        if(!empty($_GET['search'])) {
                            showContacts(getContactsPerPage($p+$contact_per_page));
                            $pg+=1;
                        }
                        elseif($p == 0) {
                            showContacts(getContactsPerPage($p));
                        }
                         else {
                            showContacts(getContactsPerPage($p+$contact_per_page));
                            $pg+=1;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-1">
                <?php
                echo '<a href="contacts.php';
                if(isset($_GET['search'])){
                    echo "?search=".$_GET['search'].'&';
                    if($pg<=getMaxPage()){
                        echo 'p='.$pg;
                    } else {
                        echo 'p='.'0';
                    }

                }else {
                    echo '?';
                    if($pg<getMaxPage()){
                        echo 'p='.($pg+1);
                    } else {
                        echo 'p='.'0';
                    }
                }    
                echo '" class="btn btn-default btn-foward">';
                ?>
                <img width="50px" src="images/back.png"/></a>
            </div>
        </div>
    </div>
</body>
</html>
