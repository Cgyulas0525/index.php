<script type="text/javascript">

    function getPartner(ertek){
        $.ajax({
            type: "GET",
            url:"{{url('api/getPartner')}}",
            data: { id: ertek },
            success: function (response) {
                console.log('Response:', response);
                return response;
            },
            error: function (response) {
                console.log('Error:', response);
                swal( "Hiba",  "A api/getPartner",  "error" );
            }
        });
    }

</script>
