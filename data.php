<?php

    // set the header to json
    header('Content-Type: applicaton/json');

    // database
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'epms_db');

    // get db connection
    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if(!$mysqli){
        die("connection failed: " . $mysqli->error);
    }

    // query to get data from the table
    $query = sprintf("SELECT Job, Salary FROM Employee ORDER BY Employee_ID");

    // query execution
    $result = $mysqli->query($query);

    // looping through the returned data
    $data = array();
    foreach ($result as $row){
        $data[] = $row;
    }

    // free memory associated with result 
    $result->close();

    // now print the data
    print json_encode($data);


?>