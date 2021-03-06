<?php 
    require_once('connection.php');

    if (isset($_REQUEST['btn_insert'])) {
        $firstname = $_REQUEST['txt_firstname'];
        $lastname = $_REQUEST['txt_lastname'];
        $age = $_REQUEST['txt_age'];
        $nationality = $_REQUEST['txt_nationality'];
        $county = $_REQUEST['txt_county'];

        if (empty($firstname)) {
            $errorMsg = "Please enter Firstname";
        } else if (empty($lastname)) {
            $errorMsg = "please Enter Lastname";
        } else if (empty($age)) {
            $errorMsg = "please Enter Age";
        } else if (empty($nationality)) {
            $errorMsg = "please Enter Nationality";
        } else if (empty($county)) {
            $errorMsg = "please Enter County";             
        } else {
            try {
                if (!isset($errorMsg)) {
                    $insert_stmt = $conn->prepare("INSERT INTO customers(firstname, lastname, age, nationality, county) VALUES (:fname, :lname, :age, :nationality, :county)");
                    $insert_stmt->bindParam(':fname', $firstname);
                    $insert_stmt->bindParam(':lname', $lastname);
                    $insert_stmt->bindParam(':age', $age);
                    $insert_stmt->bindParam(':nationality', $nationality);
                    $insert_stmt->bindParam(':county', $county);

                    if ($insert_stmt->execute()) {
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2;index.php");
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customers</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <div class="container">
    <div class="display-3 text-center">Add Customers</div>

    <?php 
         if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>
    

    <?php 
         if (isset($insertMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $insertMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Fisrtname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_firstname" class="form-control" placeholder="Enter Firstname...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_lastname" class="form-control" placeholder="Enter Lastname...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="age" class="col-sm-3 control-label">Age</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_age" class="form-control" placeholder="Enter age...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="nationality" class="col-sm-3 control-label">Nationality</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_nationality" class="form-control" placeholder="Enter nationality...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="county" class="col-sm-3 control-label">County</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_county" class="form-control" placeholder="Enter county...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>