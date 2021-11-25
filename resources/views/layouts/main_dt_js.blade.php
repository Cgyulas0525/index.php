<script>
    $(function () {
          $('#main-table').DataTable({
              serverside: true,
              processing: true,
              language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Hungarian.json"
              },
              dom: 'B<"clear">lfrtip',
              buttons: [
                        'copy',
                        {
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: [ 0, ':visible' ]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 5 ]
                            }
                        },
                        'print'
                    ]
          });
    });
</script>
