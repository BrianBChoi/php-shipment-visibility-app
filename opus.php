<?php
/*
Title: opus.php
Author: Brian Choi
Updated: 3/8/2022
Version: 1.0.0
Purpose: Consolidate functions for connecting to the LA OPUS server's database.
*/

class Opus {

  /*
  Attempts to open a connection with the production database and returns the
  connection.

  Received from Samuel Addington on 11/18/2021
  */
  public static function open_connection() {

    // Super secret login credentials for production database
    $server = "la.binexline.com";
    $instance = "OPUSSVR";
    $port = 1433;
    $database = "opusfms_binex";
    $user = "opus_fms";
    $password = "fms";

    // Open connection
    $conn = new PDO( "sqlsrv:Server={$server}\\{$instance},{$port};
                     Database={$database}", $user, $password );

    // Provide feedback on connection success
    if( $conn ) {
      // echo "Connection established.<br />";
    }else{
      // echo "Connection could not be established.<br />";
      die( print_r( sqlsrv_errors(), true));
    }

    return $conn;
  }

  // Returns the SQL query for the order table in the main page.
  public static function main_query() {

    $query = "SELECT DISTINCT TOP 100
              bl.BL_NO AS 'BL_NO',
              cntr.CNTR_NO AS 'CNTR_NO',
              cntr.CNTR_TPSZ_CD AS 'CNTR_TPSZ_CD',
              cntr.CGO_PCK_QTY AS 'CGO_PCK_QTY',
              cntr.CGO_PCK_UT AS 'CGO_PCK_UT',
              cntr.CGO_WGT AS 'CGO_WGT',
              cntr.CGO_MEAS AS 'CGO_MEAS',
              bl.POL_NM AS 'POL',
              bl.ETD_DT_TM AS 'ETD',
              bl.POD_NM AS 'POD',
              bl.ETA_DT_TM AS 'ETA',
              bl.TRNK_VSL_NM AS 'VESSEL',
              bl.TRNK_VOY AS 'VOYAGE',
              bl.MODI_TMS AS 'BL_LAST_UPDATED'

            FROM TB_INTG_BL bl

            JOIN TB_BL_PRNR prnr
            ON bl.INTG_BL_SEQ = prnr.INTG_BL_SEQ

            JOIN TB_ADD_INFO_BND updt
            ON prnr.INTG_BL_SEQ = updt.INTG_BL_SEQ

            JOIN TB_CNTR_LIST cntr
            ON updt.INTG_BL_SEQ = cntr.INTG_BL_SEQ

            WHERE prnr.TRDP_NM = 'DAS COMPANIES INC'

            ORDER BY bl.ETA_DT_TM DESC, CNTR_NO ASC";

    return $query;
  }

  public static function etd_search_query($start_date, $end_date) {

    $query = "SELECT DISTINCT
                bl.BL_NO AS 'BL_NO',
                cntr.CNTR_NO AS 'CNTR_NO',
                cntr.CNTR_TPSZ_CD AS 'CNTR_TPSZ_CD',
                cntr.CGO_PCK_QTY AS 'CGO_PCK_QTY',
                cntr.CGO_PCK_UT AS 'CGO_PCK_UT',
                cntr.CGO_WGT AS 'CGO_WGT',
                cntr.CGO_MEAS AS 'CGO_MEAS',
                bl.POL_NM AS 'POL',
                bl.ETD_DT_TM AS 'ETD',
                updt.ACT_ETD_DT_TM AS 'UPDATED_ETD',
                bl.POD_NM AS 'POD',
                bl.ETA_DT_TM AS 'ETA',
                updt.ACT_ETA_DT_TM AS 'UPDATED_ETA',
                bl.TRNK_VSL_NM AS 'VESSEL',
                bl.TRNK_VOY AS 'VOYAGE',
                bl.MODI_TMS AS 'BL_LAST_UPDATED'

              FROM TB_INTG_BL bl

              JOIN TB_BL_PRNR prnr
              ON bl.INTG_BL_SEQ = prnr.INTG_BL_SEQ

              JOIN TB_ADD_INFO_BND updt
              ON prnr.INTG_BL_SEQ = updt.INTG_BL_SEQ

              JOIN TB_CNTR_LIST cntr
              ON updt.INTG_BL_SEQ = cntr.INTG_BL_SEQ

              WHERE
                prnr.TRDP_NM = 'DAS COMPANIES INC' AND
                bl.ETD_DT_TM BETWEEN '$start_date' AND '$end_date'

              ORDER BY bl.ETA_DT_TM DESC, CNTR_NO ASC";

    return $query;
  }
}
?>
