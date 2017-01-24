<!DOCTYPE html>
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
            <div class="sign-up-container ">
                <form class="form-horizontal col-md-5">
                    <div class="form-heading">
                        <h2>Sign-Up</h2>
                        <span>Complete the following fields</span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="inputName" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Birthday</label>
                        <div class="col-sm-10">
                            <input type="birthday" class="form-control" id="inputBirthday" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit</button>
                            <button type="submit" class="btn btn-default">Export to XML</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>

</html>