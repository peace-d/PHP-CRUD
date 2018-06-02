<?php
/**
 * Created by PhpStorm.
 * User: Optimus Prime
 * Date: 2018/06/02
 * Time: 09:47 PM
 * Description: This file illustrates how to create, retrieve, update and delete data from a database in PHP
 * Copyright: This system/file is owned by Peace Dube. Unauthorised copying is prohibited
 */
require_once('classes/database.php');
require_once('includes/header.php');

// get all active contacts from the database
$database = new Database("127.0.0.1", "root", "", "phpcrud");

$contactsArray = array();
$contacts = $database->query("select * from contacts where active=1");
if ($contacts->numrows() > 0)
    while ($allContacts = $contacts->fetchrow())
    $contactsArray[] = $allContacts;
//echo '<pre>';print_r($contactsArray); die;
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1>My Contacts</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <a href="add_edit_contact.php" class="btn btn-default">Add</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="list-group">
                <?php if (!empty($contactsArray)):foreach ($contactsArray as $contact): ?>
                <a href="add_edit_contact.php?contact_id=<?= $contact['id']; ?>&action=View" class="list-group-item">
                    <?= $contact['firstname'].' '.$contact['lastname']; ?>
                    <span class="date pull-right"><i><?= date('d M Y H:i a', $contact['date_created']) ?></i></span>
                </a>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>