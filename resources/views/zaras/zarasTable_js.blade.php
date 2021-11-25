<script type="text/javascript">
    $(function () {

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var table = $('.partners-table').DataTable({
          serverSide: true,
          scrollY: 250,
          order: [[1, 'desc']],
          paging: false,
          ajax: "{{ route('zaras.index') }}",
          columns: [
              {title: 'Akció', data: 'action', sClass: "text-center", name: 'action', width:'150px', orderable: false, searchable: false},
              {title: 'Dátum', data: 'datum', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'datum'},
              {title: ' ', data: 'nev', sClass: "text-center", width:'150px', name: 'nev'},
              {title: 'Összesen', data: 'sum', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'sum'},
          ],
          footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                // Total over all pages
                total = api.column( 3 ).data().sum();
                // Total over this page
                pageTotal = api.column( 3, {page:'current'} ).data().sum();
                // Update footer
                $( api.column( 3 ).footer() ).html(
                    currencyFormatDE(total)
                );
              },
        });
    });
</script>
