<script type="text/javascript">

    function getKovetkezoSzolgaltatasCikkszam(mezo){
        $.ajax({
            type: "POST",
            url:"{{url('api/getMaxSzolgaltatasCikkszam')}}",
            data: { betu: 'S' },
            success: function (response) {
                let cikkszam = response.original;
                let ertek = "";

                console.log(response.original);

                if (isNaN(cikkszam)){
                    ertek = parseInt(cikkszam.substr(2,7)) + 1;
                }else{
                    ertek = parseInt(cikkszam) + 1;
                }
                ertek = ertek.toString();
                cikkszam = 'S-' + ertek.padStart(7, '0')
                $(mezo).val(cikkszam);
            },
            error: function (response) {
                console.log('Error:', response);
                swal( "Hiba",  "A api/getMaxSzolgaltatasCikkszam hibát generált!",  "error" );
            }
        });

    }

</script>
