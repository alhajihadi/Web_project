<?php
session_start();
include("connect.php");
include("functions.php");

if (!isset($_SESSION['loggedIn'])) {
    header("location: login.php");
} else {
    if (isset($_POST["saveMedicine"])) {

        try {

            //save user_id in variable of the database(created sql statement)
            $user_id = $_SESSION["user_id"];
           
             //retrieve variables from the sql statement
            $medicineName = trim($_POST["medicine_name"]);
            $dosageQty = intval(trim($_POST["dosage_quantity"]));
            $dosageUnit = trim($_POST["dosage_unit"]);
            $milligramQty = intval(trim($_POST["milligram_quantity"]));
            $milligramUnit = trim($_POST["milligram_unit"]);
            $frequencyQty = intval(trim($_POST["frequency_quantity"]));
            $frequencyUnit = trim($_POST["frequency_unit"]);


             //These are the Fields in the sql statement query
            $query = "INSERT INTO medicine (medicine_name, dosage_quantity, dosage_unit, milligram_quantity, milligram_unit, frequency_quantity, frequency_unit, user_ID)
                VALUES (?,?,?,?,?,?,?,?);";

            if ($statement = $con->prepare($query)) {
                if ($statement->bind_param("sisisisi", $medicineName, $dosageQty, $dosageUnit, $milligramQty, $milligramUnit, $frequencyQty, $frequencyUnit, $user_id)) {

                    if ($statement->execute()) {
                        echo '<h5 class="text-success text-center">Medicine Added Successfully</h5>';
                    } else {
                        echo '<h4 class="text-danger text-center">Error Saving Medicine</h4>';
                    }
                } else {
                    echo '<h5 class="text-danger text-center">Oops!! Something went wrong</h5>';
                }
            } else {
                echo '<h4 class="text-danger text-center">Oops!! Something went wrong</h4>';
            }


        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}


?>

<?php set_header("Save New Medicine"); ?>
<div class="container">
    <div class="row mt-5">

        <div class="col-md-8 offset-md-2">
            <h5 class="display-5">New Medicine</h5>
            <a href="index.php" class="btn btn-info pill-right mb-4">All Medicines</a>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Enter Medicine Name</label>
                    <input type="text" name="medicine_name" id="medicine_name" placeholder="Medicine Name" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Enter Dosage Quantity</label>
                    <input type="number" name="dosage_quantity" id="dosage_quantity" required class="form-control" min="1" max="200" value="1">
                </div>
                <div class="form-group">
                    <label for="">Enter Dosage Unit</label>
                    <select name="dosage_unit" id="dosage_unit" class="form-select" required>
                        <option value="Tab" selected>Tab</option>
                        <option value="Bottle">How Many Bottle</option>
                        <option value="Syringe">Enter Syringe</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">ENter Milligrams</label>
                    <input type="text" name="milligram_quantity" id="milligram" placeholder="Milligram" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Enter Unit(g/mg)</label>
                    <select name="milligram_unit" id="unit" class="form-select" required>
                        <option value="Grams" selected>Enter Grams</option>
                        <option value="MilliGrams">Enter MilliGrams</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Enter Frequency Quantity</label>
                    <input type="number" name="frequency_quantity" id="frequency_quantity" placeholder="Frequency Quantity" required class="form-control" min="1" max="200" value="1">
                </div>

                <div class="form-group">
                    <label for="">Frequency Unit</label>
                    <select name="frequency_unit" id="frequency_unit" class="form-select">
                        <option value="Daily" selected>Daily</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Montly">Monthly</option>
                    </select>
                </div>
                <input type="submit" name="saveMedicine" value="Save New Medicine" class="form-control btn btn-info btn-block my-3">
            </form>
            
        </div>
    </div>
</div>

<?php set_footer()?>