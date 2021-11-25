<script type="text/javascript">

    function getKovetekezoTermekCikkszam(ertek, mezo){
        $.ajax({
            type: "POST",
            url:"{{url('api/getMaxTermekCikkszam')}}",
            data: { csoport: ertek },
            success: function (response) {
                let cikkszam = response;
                let ertek = "";
                if (isNaN(cikkszam)){
                    ertek = parseInt(cikkszam.substr(2,7)) + 1;
                    console.log( 'isnan', ertek);
                }else{
                    ertek = parseInt(cikkszam.substr(0,7)) + 1;
                }
                ertek = ertek.toString();
                cikkszam = 'T-' + ertek
                $(mezo).val(cikkszam);
            },
            error: function (response) {
                console.log('Error:', response);
                swal( "Hiba",  "A api/getMaxTermekCikkszam hibát generált!",  "error" );
            }
        });
    }

</script>
