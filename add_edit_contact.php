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
require_once('includes/functions.php');
require_once('includes/header.php');

// instantiate our database class
$database = new Database("127.0.0.1", "root", "", "phpcrud");

$statusArray = array('inactive', 'active');

$saveUpdateBtn = "<input type=\"submit\" name=\"action\" class=\"btn btn-primary\" value=\"Save\">";
$disabled = $message = $editFirstname = $editLastname = $editContact = $editEmail = $editDateCreated = '';
$currentTime = time();


$action     = isset($_REQUEST['action']) ? $_REQUEST['action']: '';
$contactID  = isset($_REQUEST['contact_id']) ? $_REQUEST['contact_id']: '';
$firstname  = isset($_POST['firstname']) ? $_POST['firstname']: '';
$lastname   = isset($_POST['lastname'])  ? $_POST['lastname'] : '';
$contact    = isset($_POST['contact'])   ? $_POST['contact']  : '';
$email      = isset($_POST['email'])     ? $_POST['email']    : '';
$active     = isset($_POST['active'])    ? $_POST['active']   : 0;

if ($action == 'Save')
{
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
    $saveUpdateBtn = "<input type=\"submit\" name=\"action\" class=\"btn btn-primary\" value=\"Update\">";

    // get data to be edited
    $contactInfo = $database->query("select * from contacts where id=$contactID")->fetchrow();
    $editContactID  = $contactInfo['id'];
    $editFirstname  = $contactInfo['firstname'];
    $editLastname   = $contactInfo['lastname'];
    $editContact    = $contactInfo['contact'];
    $editEmail      = $contactInfo['email'];

    $statusOptions = selectOptions($statusArray, $contactInfo['active']);
}
elseif ($action == 'View')
{
    $disabled = "disabled=\"disabled\"";
    $saveUpdateBtn = "";

    // get data to be viewed
    $contactInfo = $database->query("select * from contacts where id=$contactID")->fetchrow();
    $editDateCreated = date('d M Y H:i a',$contactInfo['date_created']);
    $editContactID  = $contactInfo['id'];
    $editFirstname  = $contactInfo['firstname'];
    $editLastname   = $contactInfo['lastname'];
    $editContact    = $contactInfo['contact'];
    $editEmail      = $contactInfo['email'];
    $statusOptions = selectOptions($statusArray, $contactInfo['active']);

}
elseif ($action == 'Update')
{
    $result = $database->query("update contacts set firstname='$firstname', lastname='$lastname', contact='$contact', email='$email', active=$active where id=$contactID");
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

    header("Location: add_edit_contact.php?contact_id=$contactID&action=View&status=Success");
}
elseif ($action == 'Delete')
{
    $result = $database->query("delete from contacts where id=$contactID");
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
    header("Location: index.php");
}

?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?= $message ?>
                <h1><?= $editFirstname.' '.$editLastname?></h1><small><?= $editDateCreated; ?></small>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <a href="index.php" class="btn btn-default">Back</a>
                <?php if ($action == 'View'): ?>
                    <a href="#" class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete ?')) window.location='add_edit_contact.php?contact_id=<?= $contactID ?>&action=Delete'">Delete</a>
                    <a href="add_edit_contact.php?contact_id=<?= $contactID; ?>&action=Edit" class="btn btn-warning">Edit</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <form method="post" action="add_edit_contact.php">
                    <input type="hidden" name="contact_id" value="<?= $editContactID; ?>">
                    <div class="form-group">
                        <label for="firstname">Firstname*:</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="<?= $editFirstname; ?>" required="required" <?= $disabled ?> />
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname*:</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $editLastname; ?>"  required="required"  <?= $disabled ?>/>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact*:</label>
                        <input type="text" class="form-control" name="contact" id="contact" value="<?= $editContact; ?>"  required="required"  <?= $disabled ?> />
                    </div>
                    <div class="form-group">
                        <label for="contact">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $editEmail; ?>"   <?= $disabled ?> />
                    </div>
                    <div class="form-group">
                        <label for="contact">Status:</label>
                        <select class="form-control" name="active" id="active" <?= $disabled ?>><?= $statusOptions; ?></select>
                    </div>
                    <?= $saveUpdateBtn ?>
                </form>
            </div>
        </div>
    </div>

<?php require_once('includes/footer.php'); ?>