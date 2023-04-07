<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>

<h1>Enter household info</h1>
<body bgcolor="1A5C93">
    
    <form action='connection.php' method="POST">
        <label for="email">Please enter your email address:</label><br>
        <input type='email' name='email' id="email" required/> <br> <br>

        <label for="postal_code">Please enter your five digit postal code:</label>
        <input type='text' name='postal_code' id="postal_code" required/> <br> <br>

        <?php echo 'Please enter the following details for your household.'?> <br>

        <label for="house_type">Home type:</label>
        <select id="house_type" name='house_type'>
        <option value="house">House</option>
        <option value="apartment">Apartment</option>
        <option value="townhome">Townhome</option>
        <option value="condominium">Condominum</option>
        <option value="mobilehome">Mobile Home</option>
        </select> <br> <br>
    
        <label for="square_footage">Square footage:</label>
        <input type='number' min="0" pattern=" 0+\.[0-9]*[1-9][0-9]*$" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name='square_footage' id="square_footage" required/> <br> <br>

        <label for="heat_setting">Thermostat setting for heating:</label>
        <input type='number' min="0" pattern=" 0+\.[0-9]*[1-9][0-9]*$" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name='heat_setting' id="heat_setting"/> 
        <input type="checkbox" id="no_heat" name="no_heat">
        <label for="no_cheat">No heat</label><br><br> 

        <label for="cool_setting">Thermostat setting for cooling:</label>
        <input type='number' min="0" pattern=" 0+\.[0-9]*[1-9][0-9]*$" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name='cool_setting' id="cool_setting"/> 
        <input type="checkbox" id="no_cool" name="no_cool">
        <label for="no_cool">No cooling</label><br><br>

        <label for="utilities">Public utilities:</label> <br>
        <?php echo '(if none, leave unchecked)'?>

        <div class="utils">
        <input type="checkbox" id="electric" name="electric">
        <label for="electric">Electric</label><br>

        <input type="checkbox" id="gas" name="gas">
        <label for="gas">Gas</label><br>

        <input type="checkbox" id="steam" name="steam">
        <label for="steam">Steam</label><br>

        <input type="checkbox" id="fuel" name="fuel">
        <label for="fuel">Fuel oil</label><br>
        </div>
        <br><br> 
        <input type='submit' name='submit' id="submit" value="Next"> 
    </form>
</body>
</html>
        <?php
            require_once('connection.php');
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                if (isset($_POST['email']) && isset($_POST['postal_code']) && !empty($_POST['house_type']) && isset($_POST['square_footage'])
                && isset($_POST['heat_setting']) && isset($_POST['cool_setting'])) {
                    $email=$_POST['email'];
                    $postal_code=$_POST['postal_code'];
                    $house_type=$_POST['house_type'];
                    $square_footage=$_POST['square_footage'];
                    $heat_setting=$_POST['heat_setting'];
                    $cool_setting=$_POST['cool_setting'];
                    $sql= "INSERT INTO publicutility (email, public_utilities) VALUES ('$email', 'electric')";
                    $query = mysqli_query($conn,$sql);
                    if($query) {
                        echo 'Entry Successful';   
                    }
                    else {
                        echo 'Error Occurred';
                    }
                    $sql = "INSERT INTO postalcode (code, city, state, latitude, longitude) 
                    VALUES ('$postal_code', 'Towson', 'MD', 20.5, 50.5)";
        
                    $query = mysqli_query($conn,$sql);
                    if($query) {
                        echo 'Entry Successful';   
                    }
                    else {
                        echo 'Error Occurred';
                    }
                    if (isset($_POST['heat_setting']) && isset($_POST['cool_setting'])){
                        $sql= "INSERT INTO household (email, square_footage, type, heat_setting, cool_setting, code) 
                        VALUES ('$email', '$square_footage', '$house_type', '$heat_setting', '$cool_setting', '$postal_code')";
        
                        $query = mysqli_query($conn,$sql);
                        if($query) {
                        echo 'Entry Successful';   
                        }
                        else {
                            echo 'Error Occurred';
                        }
                    }
                    elseif (isset($_POST['no_cool']) && isset($_POST['no_heat'])){
                        $sql= "INSERT INTO household (email, square_footage, type, NULL, NULL, code) 
                        VALUES ('$email', '$square_footage', '$house_type', '$postal_code')";
        
                        $query = mysqli_query($conn,$sql);
                        if($query) {
                        echo 'Entry Successful';   
                        }
                        else {
                            echo 'Error Occurred';
                        }
                    } 
                    elseif (isset($_POST['no_cool']) && isempty($_POST['no_heat'])){
                        $sql= "INSERT INTO household (email, square_footage, type, heat_setting, NULL, code) 
                        VALUES ('$email', '$square_footage', '$house_type', '$heat_setting', '$postal_code')";
        
                        $query = mysqli_query($conn,$sql);
                        if($query) {
                        echo 'Entry Successful';   
                        }
                        else {
                            echo 'Error Occurred';
                        }
                    } 
                    elseif (isempty($_POST['no_cool']) && isset($_POST['no_heat'])){
                        $sql= "INSERT INTO household (email, square_footage, type, NULL, cool_setting, code) 
                        VALUES ('$email', '$square_footage', '$house_type', '$cool_setting', '$postal_code')";
        
                        $query = mysqli_query($conn,$sql);
                        if($query) {
                        echo 'Entry Successful';   
                        }
                        else {
                            echo 'Error Occurred';
                        }
                    } 

                    if (isset($_POST['electric'])){
                        $sql= "INSERT INTO publicutility (email, public_utilities) VALUES ('$email', 'electric')";
                        $query = mysqli_query($conn,$sql);
                        if($query) {
                        echo 'Entry electric';   
                        }
                        else {
                            echo 'Error electric';
                        } 
                    }

                    if (isset($_POST['gas'])){
                        $sql= "INSERT INTO publicutility (email, public_utilities) VALUES ('$email', 'gas')";
                        $query = mysqli_query($conn,$sql);
                        if($query) {
                        echo 'Entry gas';   
                        }
                        else {
                            echo 'Error gas';
                        } 
                    }

                    if (isset($_POST['steam'])){
                        $sql= "INSERT INTO publicutility (email, public_utilities) VALUES ('$email', 'steam')";
                        $query = mysqli_query($conn,$sql);
                        if($query) {
                        echo 'Entry Steam';   
                        }
                        else {
                            echo 'Error steam';
                        } 
                    }

                    if (isset($_POST['fuel'])){
                        $sql= "INSERT INTO publicutility (email, public_utilities) VALUES ('$email', 'fuel_oil')";
                        $query = mysqli_query($conn,$sql);
                        if($query) {
                        echo 'Entered fuel';   
                        }
                        else {
                            echo 'Error Fuel';
                        }
                    }

                }
           
            }

         ?>

