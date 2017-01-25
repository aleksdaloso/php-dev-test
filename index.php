<!DOCTYPE html>

<?php
include('./class/App.php');
$app = new App();
if(isset($_POST['signup'])){
    $validate = $app->validate($_POST);
    if($validate === true) {
        if($app->saveToFile($_POST)){
            $type = "success";
            $message = "Data successfully save!";
        } else {
            $type = "danger";
            $message = "Something went wrong. Please try again!";
        }
    } else {
        $type = "danger";
        $message = $validate;
    }

    $alertMessage = array(
        'type' => $type,
        'message' => $message,
    );


}

if(isset($_POST['export'])) {
    $export = $app->exportData();
     var_dump($export);
}

?>
<html>
    <head>
        <title>Signup</title>
        <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
    </head>

    <body>
        <div class="container ">
            <div class="row">
                <div class="sign-up-container">
                    <form class="form-horizontal col-md-5" action="/" method="post">
                        <div class="form-heading">
                            <h2>Sign-Up</h2>
                            <span>Complete the following fields</span>
                            <?php if(isset($alertMessage)) { ?>
                                <div class="alert alert-<?= $alertMessage['type'] ?>" role="alert"><?= $alertMessage['message']; ?></div>
                            <?php } ?>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-4 control-label">Name <span>First name only</span></label>
                            <div class="col-sm-8">
                                <input type="name" class="form-control" id="inputName" name="inputName" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Birthday <span>mm-dd-yyyy</span></label>
                            <div class="col-sm-8">
                                <input type="birthday" class="form-control" id="inputBirthday" placeholder="" name="inputBirthday">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" name="signup" class="btn btn-default">Submit</button>
                                <button type="submit" name="export" class="btn btn-default">Export to XML</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>