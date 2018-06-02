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

$saveUpdateBtn = "Save";
$disabled = $message = '';
$currentTime = time();


$action     = isset($_POST['action'])       ? $_POST['action']      : '';
$firstname  = isset($_POST['firstname']) ? $_POST['firstname']: '';
$lastname   = isset($_POST['lastname'])  ? $_POST['lastname'] : '';
$contact    = isset($_POST['contact'])   ? $_POST['contact']  : '';
$email      = isset($_POST['email'])     ? $_POST['email']    : '';
$active     = isset($_POST['active'])    ? $_POST['active']   : 0;

if ($action == 'Save')
{
    // instantiate our database class
    $database = new Database("127.0.0.1", "root", "", "phpcrud");

    $result = $database->query("insert into contacts (date_created, firstname, lastname, contact, email, active) values($currentTime, '$firstname', '$lastname', '$contact', '$email',1)");
    if ($database->affectedRows() > 0)
    {
        $message = <<<HTML
            <p class="alert alert-success">Record added successfully</p> 
HTML;
    }
    else
    {
        $message = <<<HTML
            <p class="alert alert-danger">Could not add contact</p> 
HTML;
    }
}
elseif ($action == 'Edit')
{
    $saveUpdateBtn = 'Update';
}
elseif ($action == 'View')
{
    $disabled = "disabled=\"disabled\"";
}

?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?= $message ?>
                <h1>Peace Dube</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <a href="index.php" class="btn btn-default">Back</a>
                <?php if ($action == 'edit'): ?>
                    <a href="#" class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete ?')) window.location='add_edit_contact.php?contact_id=&action=delete'">Delete</a>
                    <a href="add_edit_contact.php" class="btn btn-warning">Edit</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <form method="post" action="add_edit_contact.php">
                    <div class="form-group">
                        <label for="firstname">Firstname*:</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" required="required" <?= $disabled ?> />
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname*:</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" required="required"  <?= $disabled ?>/>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact*:</label>
                        <input type="text" class="form-control" name="contact" id="contact" required="required"  <?= $disabled ?> />
                    </div>
                    <div class="form-group">
                        <label for="contact">Email:</label>
                        <input type="email" class="form-control" name="email" id="email"  <?= $disabled ?> />
                    </div>
                    <input type="submit" name="action" class="btn btn-primary" value="<?= $saveUpdateBtn; ?>">
                </form>
            </div>
        </div>
    </div>

<?php require_once('includes/footer.php'); ?>