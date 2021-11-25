<script type="text/javascript">
    $(function () {

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var table = $('.atlagTable').DataTable({
          serverSide: true,
          scrollY: 250,
          order: [[1, 'asc']],
          paging: false,
          ajax: "{{ route('atlagNapi') }}",
          columns: [
              {title: ' ', data: 'nev', sClass: "text-center", width:'150px', name: 'nev'},
              {title: ' ', data: 'nap', name: 'nap'},
              {title: 'Átlag', data: 'osszeg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'osszeg'},
              {title: 'Összesen', data: 'napisum', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'napisum'},
          ],
          columnDefs: [
                {
                visible: false,
                targets: [1]
                },
            ],        });
    });
</script>
