// Title: main-table-defaullt.js
// Author: Brian Choi
// Updated: 3/8/2022
// Version: 1.0.0
// Purpose: Script for showing the main page's table using the DataTable library

// Formatting function for additional container information
function format(d){
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
  '<tr>'+
      '<td> CNTR_TPSZ_CD : </td>'+
      '<td>'+d.CNTR_TPSZ_CD+'</td>'+
  '</tr>'+
  '<tr>'+
      '<td> CGO_PCK_QTY : </td>'+
      '<td>'+d.CGO_PCK_QTY+'</td>'+
  '</tr>'+
  '<tr>'+
      '<td> CGO_PCK_UT : </td>'+
      '<td>'+d.CGO_PCK_UT+'</td>'+
  '</tr>'+
  '<tr>'+
      '<td> CGO_WGT : </td>'+
      '<td>'+d.CGO_WGT+'</td>'+
  '</tr>'+
  '<tr>'+
      '<td> CGO_MEAS : </td>'+
      '<td>'+d.CGO_MEAS+'</td>'+
  '</tr>'+
  '</table>';
}

// Process table through DataTable() function
$(document).ready(function () {
    var table = $('#main-table').DataTable({
        ajax: {
            url: "main_table_default.php",
            type: "POST",
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus + "\n" + errorThrown);
                console.log(jqXHR);
            }
        },
        // Rendering dates by rearranging substrings proposed by Jacob Lee
        columns: [
            {
                "className":      'dt-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'BL_NO' },
            { data: 'CNTR_NO' },
            { data: 'POL' },
            { data: 'ETD',
              render: function(data) {
                return data.substring(4,6) + "-" + data.substring(6) + "-"
                        + data.substring(0,4);
              },
            },
            { data: 'POD' },
            { data: 'ETA',
              render: function(data) {
                return data.substring(4,6) + "-" + data.substring(6) + "-"
                        + data.substring(0,4);
            },
            },
            { data: 'VESSEL' },
            { data: 'VOYAGE' },
            { data: 'BL_LAST_UPDATED',
              render: function(data) {
                return data.substring(5,8) + data.substring(8,10) + "-"
                        + data.substring(0,4) + data.substring(10);
              },
            }
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength: 50,
        processing: true,
        colReorder: true,
        scrollY:"60%",
        scrollX: true,
        sScrollXInner: "100%"
        // git test pt 2
    });

    // Event listener for opening and closing container details
    $('#main-table tbody').on('click', 'td.dt-control', function() {
      var tr = $(this).closest('tr');
      var row = table.row(tr);

      if (row.child.isShown() ){
          row.child.hide();
          tr.removeClass('shown');
      }

      else {
          row.child(format(row.data())).show();
          tr.addClass('shown');
      }
    });
});
