<script type="text/javascript">

    function getKovetkezoSzolgaltatasCikkszam(){
        $.ajax({
            type: "POST",
            url: '{{url('api/getMaxSzolgaltatasCikkszam')}}',
            data: "&betu=S",
            success: function (response) {
                console.log(response);
                CIKKSZAM = 'S-'+ response.original;
                cikkszam('S');
            },
            error: function (response) {
                console.log('Error:', response);
            }
        });
    }

    function cikkszam(betu) {
        let ertek = parseInt(CIKKSZAM) + 1;
        CIKKSZAM = betu + '-' + ertek.toString();

        $('#cikkszam').val(CIKKSZAM);
    }

    function getKovetekezoTermekCikkszam(ertek) {
        $.ajax({
            type: "POST",
            url: '{{url('api/getMaxTermekCikkszam')}}',
            data: "&csoport=" + ertek,
            success: function (response) {
                CIKKSZAM = response;
                cikkszam('T')
            },
            error: function (response) {
                console.log('Error:', response);
            }
        });
    }

    function getFocsoportFromCsoport(ertek) {
        if (ertek != 0) {
            $.ajax({
                type: "POST",
                url: '{{url('api/getFocsoportFromCsoport')}}',
                data: "&id=" + ertek,
                success: function (response) {
                    console.log(response);
                    let resp = parseInt(response[0].tsz);
                    if ( resp == 2071 ){
                        // Termék
                        getKovetekezoTermekCikkszam(ertek);
                    }else if ( resp == 2072){
                        // Szolgáltatás
                        getKovetkezoSzolgaltatasCikkszam();
                    }
                },
                error: function (response) {
                    console.log('Error:', response);
                }

            });
        }else{
            $('#cikkszam').val(null);
        }
    }

</script>
