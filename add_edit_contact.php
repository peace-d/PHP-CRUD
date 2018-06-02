<?php
/**
 * Created by PhpStorm.
 * User: Optimus Prime
 * Date: 2018/06/02
 * Time: 10:46 PM
 * Description: View client information
 * Copyright: This system/file is owned by Peace Dube. Unauthorised copying is prohibited
 */
require_once('classes/database.php');
require_once('includes/header.php');

$sSaveUpdateBtn = "Save";

?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Peace Dube</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <a href="index.php" class="btn btn-default">Back</a>
                <a href="#" class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete ?')) window.location='add_edit_contact.php?contact_id=&action=delete'">Delete</a>
                <a href="add_edit_contact.php" class="btn btn-warning">Edit</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="firstname">Firstname*:</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" required="required" disabled="disabled" />
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname*:</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" required="required"  disabled="disabled"/>
                </div>
                <div class="form-group">
                    <label for="contact">Contact*:</label>
                    <input type="text" class="form-control" name="contact" id="contact" required="required" disabled="disabled" />
                </div>
                <div class="form-group">
                    <label for="contact">Email:</label>
                    <input type="email" class="form-control" name="email" id="email"  disabled="disabled"/>
                </div>
                <input type="submit" class="btn btn-primary" value="<?= $sSaveUpdateBtn; ?>">
            </div>
        </div>
    </div>

<?php require_once('includes/footer.php'); ?>