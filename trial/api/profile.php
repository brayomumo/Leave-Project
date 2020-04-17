<?php
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

if(isset($_POST["user_id"])){
    echo (getDetails($_POST["user_id"]));
}
?>