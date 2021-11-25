<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>

<script src="https://cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.20/filtering/type-based/phoneNumber.js"></script>


<script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.5.1/js/dataTables.keyTable.min.js"></script>

<!--
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
-->
<script>

    function urlChange(table, url) {
        table.ajax.url(url).load();
    }

    function currencyFormatDE(num) {
       return (
         num
           .toFixed(0) // always two decimal digits
           .replace('.', ',') // replace decimal point character with ,
           .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
       ) // use . as a separator
     }

    $.extend( true, $.fn.dataTable.defaults, {
        language: {
           "sEmptyTable": "Nincs rendelkezésre álló adat",
           "sInfo": "Találatok: _START_ - _END_ Összesen: _TOTAL_",
           "sInfoEmpty": "Nulla találat",
           "sInfoFiltered": "(_MAX_ összes rekord közül szűrve)",
           "sInfoPostFix": "",
           "sInfoThousands": " ",
           "sLengthMenu": "_MENU_ találat oldalanként",
           "sLoadingRecords": "Betöltés...",
           "sProcessing": "Feldolgozás...",
           "sSearch": "Keresés:",
           "sZeroRecords": "Nincs a keresésnek megfelelő találat",
           "oPaginate": {
               "sFirst": "Első",
               "sPrevious": "Előző",
               "sNext": "Következő",
               "sLast": "Utolsó"
           },
           "oAria": {
               "sSortAscending": ": aktiválja a növekvő rendezéshez",
               "sSortDescending": ": aktiválja a csökkenő rendezéshez"
           },
           "select": {
               "rows": {
                   "_": "%d sor kiválasztva",
                   "0": "",
                   "1": "1 sor kiválasztva"
               }
           },
           "buttons": {
               "print": "Nyomtatás",
               "colvis": "Oszlopok",
               "copy": "Másolás",
               "copyTitle": "Vágólapra másolás",
               "copySuccess": {
                   "_": "%d sor másolva",
                   "1": "1 sor másolva"
               }
           }
        },
        processing: true,
        pagingType: 'full_numbers',
        select: true,
        scrollY: 500,
        scrollX: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Mind"]],
        dom: 'B<"clear">lfrtip',
        buttons: [
                  {
                    extend:    'copyHtml5',
                    text:      '<i class="fa fa-files-o"></i>',
                    titleAttr: 'Másolás',
                     exportOptions: {
                         columns: [ ':visible' ]
                     },
                  },

                  {
                      extend: 'csvHtml5',
                      text: '<i class="fa fa-file-code-o"></i>',
                      titleAttr: 'CSV',
                      exportOptions: {
                          columns: [ ':visible' ]
                      },
                  },
                  {
                      extend: 'excelHtml5',
                      text: '<i class="fa fa-file-excel-o"></i>',
                      titleAttr: 'Excel',
                      exportOptions: {
                          columns: [ ':visible' ]
                      },
                  },
                  {
                      extend: 'pdfHtml5',
                      text:      '<i class="fa fa-file-pdf-o"></i>',
                      titleAttr: 'PDF',
                      exportOptions: {
                          columns: [ ':visible' ]
                      },
                  }
              ],

    } );
</script>
