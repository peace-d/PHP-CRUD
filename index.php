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
                <a href="add_edit_contact.php" class="list-group-item">
                    Peace Dube
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>