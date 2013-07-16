<?php
 
/*
 * Following code will create a new row in noise database
 * All noiset details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['sex']) && isset($_POST['firstn']) && isset($_POST['lastn']) && isset($_POST['business']) && isset($_POST['myage']) && isset($_POST['telep']) && isset($_POST['myemail']) && isset($_POST['myarea']) && isset($_POST['loginname'])) {
 
    $fname = $_POST['firstn'];
    $lname = $_POST['lastn'];
    $age = $_POST['myage'];
	$sex = $_POST['sex'];
	$business = $_POST['business'];
	$email = $_POST['myemail'];
	$tel = $_POST['telep'];
	$area = $_POST['myarea'];
	$loginname = $_POST['loginname'];
	
	$pin="";
	$str = "0123456789";
	for($i=0;$i<5;$i++){
	   $pin .=$str[rand(0,strlen($str)-1)];
	}
	 
    // include db connect class
    //require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    //$db = new DB_CONNECT();
 $con = mysql_connect("localhost", "root", "");  //this is the real username and password

if (!$con)
  {
      die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("remote_android", $con);
 /*   $result = mysql_query("INSERT INTO try(fname,lname)VALUES('$fname','$lname')");*/
  // mysql inserting a new row
    $result = mysql_query("INSERT INTO subscribers(fname, lname, Age, Sex, email, telNo, Area_de_Oper, Business_Type, loginname,Business_code) VALUES('$fname', '$lname', '$age' , '$sex', '$email','$tel','$area','$business','loginname','$pin')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "User successfully added.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = " '$age' , Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>