<script type="text/javascript">

    function afaSzazMezobe(ertek, mezo){
        $.ajax({
            type: "GET",
            url:"{{url('api/getTermekAfaId')}}",
            data: { id: ertek },
            success: function (response) {
                if ( response != 0 ) {
                    var afa = parseInt(response);
                    $(mezo).val(afa);
                }
            },
            error: function (response) {
                console.log('Error:', response);
                swal( "Hiba",  "A api/getTermekAfaId hibát generált!",  "error" );
            }
        });
    }

</script>
