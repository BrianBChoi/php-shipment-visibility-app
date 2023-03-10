// Title: admin-table.js
// Author: Brian Choi
// Updated: 1/27/2022
// Version: 1.0.0
// Purpose: Script for showing the admin page's table using the DataTable library

$(document).ready(function () {
  $('#admin-table').DataTable({
    columnDefs: [
      {
        targets: 5,
        className: 'dt-center'
      },
      {
        targets: 6,
        className: 'dt-center'
      }
    ],
    colReorder: true,
    scrollY:"60%",
    scrollX: true,
    sScrollXInner: "100%"
  });
});
