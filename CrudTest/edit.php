<?php 
    require_once('connection.php');

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $conn->prepare("SELECT * FROM customers WHERE id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        $firstname_up = $_REQUEST['txt_firstname'];
        $lastname_up = $_REQUEST['txt_lastname'];
        $age_up = $_REQUEST['txt_age'];
        $nationality_up = $_REQUEST['txt_nationality'];   
        $county_up = $_REQUEST['txt_county']; 


        if (empty($firstname_up)) {
            $errorMsg = "Please Enter Fisrtname";
        } else if (empty($lastname_up)) {
            $errorMsg = "Please Enter Lastname";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $conn->prepare("UPDATE customers SET firstname = :fname_up, lastname = :lname_up, age = :age_up, nationality = :nationality_up, county = :county_up WHERE id = :id");
                    $update_stmt->bindParam(':fname_up', $firstname_up);
                    $update_stmt->bindParam(':lname_up', $lastname_up);
                    $update_stmt->bindParam(':age_up', $age_up);
                    $update_stmt->bindParam(':nationality_up', $nationality_up);
                    $update_stmt->bindParam(':county_up', $county_up);
                    $update_stmt->bindParam(':id', $id);

                    if ($update_stmt->execute()) {
                        $updateMsg = "Record update successfully...";
                        header("refresh:2;index.php");
                    }
                }
            } catch(PDOException $e) {
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
    <title>Update</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <div class="container">
    <div class="display-3 text-center">Edit Page</div>

    <?php 
         if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>
    

    <?php 
         if (isset($updateMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $updateMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Fisrtname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_firstname" class="form-control" value="<?php echo $firstname; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_lastname" class="form-control" value="<?php echo $lastname; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="age" class="col-sm-3 control-label">Age</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_age" class="form-control" value="<?php echo $age; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="nationality" class="col-sm-3 control-label">Nationality</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_nationality" class="form-control" value="<?php echo $nationality; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="county" class="col-sm-3 control-label">County</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_county" class="form-control" value="<?php echo $county; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>

    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>