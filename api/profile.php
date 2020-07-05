<?php
require('../auth.php');
function getDetails($id){
    include("../db.php");
    $query = "SELECT * FROM users WHERE user_id='$id'";
    $res = mysqli_query($con, $query) or die(mysqli_error($con));
    $row = mysqli_fetch_array($res);
    $obj = array_fill_keys(array("username","firstname","lastname","phonenumber","email","placeofwork","workArea","homeArea","cartype","carplatenumber","licencenumber" ),"");
    if($res){
        $obj["username"] = $row["username"];
        $obj["firstname"] = $row["first_name"];
        $obj["lastname"] = $row["last_name"];
        $obj["phonenumber"] = $row["phone_number"];
        $obj["email"] = $row["email"];
        $obj["placeofwork"] = $row["place_of_work"];
        $obj["workArea"] = $row["workArea"];
        $obj["homeArea"] = $row["homeArea"];
        $obj["cartype"] = $row["cartype"];
        $obj["carplatenumber"] = $row["car_plate_number"];
        $obj["licencenumber"] = $row["licence_number"];
    }
    return json_encode($obj);
}
function deleteAccount($id){
    include("../db.php");
    $query = "DELETE FROM  users where user_id = '$id'";
    $q = mysqli_query($con,$query) or die(mysqli_error($con));
    if($q){
        return "Account deleted successfully";
    }
}
function updateAccount($id, $details){
    $username = $details["username"];
    $firstname = $details["firstname"];
    $lastname = $details["lastname"];
    $email = $details["email"];
    $phonenumber = $details["phonenumber"];
    $licencenumber = $details["licencenumber"];
    $placeofwork = $details["placeofwork"];
    $workarea = $details["workarea"];
    $homearea = $details["homearea"];
    $carplatenumber = $details["carplatenumber"];
    $cartype = $details["cartype"];

}
function updateHome($homearea){
    include('../db.php');
    $userid = $_SESSION['id'];
    $query = "UPDATE users SET homeArea= '$homearea'  WHERE user_id='$userid'";
    $q = mysqli_query($con, $query) or die(mysqli_error($con));
    if ($q){
        return " update successfully ";
    }else{
        return "Error in updating";
    }
}
function updateWork($workplace, $company){
    include('../db.php');
    $userid = $_SESSION['id'];
    $query = "UPDATE users SET workArea= '$workplace', place_of_work='$company'  WHERE user_id='$userid'";
    $q = mysqli_query($con, $query) or die(mysqli_error($con));
    if ($q){
        return " update successfully ";
    }else{
        return "Error in updating";
    }
}
if(isset($_POST["user_id"])){
    echo (getDetails($_POST["user_id"]));
}else if (isset($_POST["newHomeArea"])){
    print_r(updateHome($_POST["newHomeArea"]));
}
else if(isset($_POST['newWorkArea'])){
    print_r(updateWork($_POST['newWorkArea'], $_POST['newCompany']));
}
?>