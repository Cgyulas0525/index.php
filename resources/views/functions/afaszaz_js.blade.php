<script type="text/javascript">

    function afaSzaz(afaId) {
        var SITEURL = "{{url('/')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let szazalek = 0;
        $.ajax({
            type: "POST",
            url: SITEURL + '/api/getAfaSzazalek',
            data: "&id=" + afaId,
            success: function (response) {
                szazalek = parseInt(response[0].afaszaz);
            },
            error: function (response) {
                console.log('Error:', response);
            }
        });
        return szazalek;
    }
</script>
