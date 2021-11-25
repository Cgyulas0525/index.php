<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* json = JSON.parse(json)   -- stringből objektum
    /* json = JSON.stringify(json) -- objektumból string  átadás átvétel

</script>
