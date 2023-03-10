// Title: main-table-defaullt.js
// Author: Brian Choi
// Updated: 1/27/2022
// Version: 1.0.0
// Purpose: Upon ETD search button click, updates main table

document.getElementById("date-search-button").onclick = main;

function main() {
  loadCookies();
  showTable();
}

function loadCookies() {
  var startDate = document.getElementById("start-date").value;
  var endDate = document.getElementById("end-date").value;
  document.cookie=`etd_start_date=${startDate}`;
  document.cookie=`etd_end_date=${endDate}`;
}

function showTable() {
  var table = $('#main-table').DataTable();

  table.ajax.url( "main_table_etd_search.php" ).load();
}
