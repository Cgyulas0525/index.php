<script type="text/javascript">

    function termekAfaSzazalek(ertek){
        $.ajax({
            type: "GET",
            url:"{{url('api/getTermekAfaSzazalek')}}",
            data: { id: ertek },
            success: function (response) {
                console.log('Response:' + response);
                return response;
            },
            error: function (response) {
                console.log('Error:', response);
                swal( "Hiba",  "A api/getTermekAfaSzazalek hibát generált!",  "error" );
            }
        });
    }

</script>
