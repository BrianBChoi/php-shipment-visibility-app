<?php
// Title: main_table_default.php
// Author: Brian Choi
// Updated: 1/27/2022
// Version: 1.0.0
// Purpose: Outputs default data for main table

/* Provides connector for production server database and a function for
      returning the main query string */
require("opus.php");

try {
    // Open and load connection with production server
    $conn = Opus::open_connection();
    // Load main query
    $query = Opus::main_query();
    /* Query the production database

                Method of showing results in a table inspired by Jacob Lee
                */
    $result = $conn->query($query);
    $array = ["data" => []];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $obj = [];
        foreach ($row as $key => $value) $obj[$key] = $value;
        $array["data"][] = $obj;
    }
    echo json_encode($array);
    $conn = NULL;
} catch (Exception $e) {
    die($e);
}
