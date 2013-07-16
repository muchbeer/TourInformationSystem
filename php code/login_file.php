<?php
 
/*
 * select a row in kcca database
 * All login details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['login_name']) && isset($_POST['password'])) {
 
    $username = $_POST['login_name'];
    $password = $_POST['password'];
   
 
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
    // mysql inserting a new row
    $result = mysql_query("SELECT count(*) FROM tax_operators WHERE login_name=\"$username\" AND password= \"$password\";");
 $r = mysql_num_rows($result);
$row= mysql_fetch_row($result);
    // check if the query returns a row
    if ($row[0]==1) {
        // successfully logged in
        $response["success"] = 1;
        $response["message"] = "Login successful.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to login
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>