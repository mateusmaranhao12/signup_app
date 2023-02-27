<?php 

    $db_conn = new mysqli("localhost", "root", "", "signup_app");

    if ($db_conn->connect_error) {
        die("DataBase Connection failed: " . $db_con->connect_error);
    }

?>