<script type="text/javascript">
    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.heti-table').DataTable({
            serverSide: true,
            scrollY: 300,
            paging: false,
            order: [[0, 'asc']],
            ajax: "{{ route('hetiBevetelKiadas') }}",
            columns: [
                {title: 'Hét', data: 'nev', name: 'nev'},
                {title: 'Bevétel', data: 'bev', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'bev'},
                {title: 'Kiadás', data: 'kiad', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'kiad'},
            ],
        });
    });
</script>
