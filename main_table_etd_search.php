<?php
// Title: main_table_etd.php
// Author: Brian Choi
// Updated: 1/26/2022
// Version: 1.0.0
// Purpose: Outputs data for ETD search

/* Provides connector for production server database and a function for
      returning the main query string */
require("opus.php");

try {
    // Open and load connection with production server
    $conn = Opus::open_connection();

    // Load main query
    $start_date = str_replace("-", "", $_COOKIE["etd_start_date"]);
    unset($_COOKIE["etd_start_date"]);
    $end_date = str_replace("-", "", $_COOKIE["etd_end_date"]);
    unset($_COOKIE["etd_end_date"]);
    $query = Opus::etd_search_query($start_date, $end_date);
    // $query = Opus::main_query();

    // Query the database
    $result = $conn->query($query);

    $array = ["data" => []];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $obj = [];
        foreach ($row as $key => $value) $obj[$key] = $value;
        $array["data"][] = $obj;
    }
    // Echo so Datatables can see the results
    echo json_encode($array);
    $conn = NULL;
} catch (Exception $e) {
    die($e);
}
