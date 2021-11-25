<script type="text/javascript">

    function fieldsVisible(melyik) {

        let mezok = ['#me', '#minmenny', '#mennyiseg', '#beszar', '#ar', '#glutenmentes', '#laktozmentes',
                     '#tejmentes', '#tojasmentes', '#cukormentes', '#vegan', '#partner', '#barcode',
                     '#energiakj', '#energiakcal', '#zsir', '#telitett', '#szenhidrat', '#cukor',
                     '#rost', '#feharje', '#so', '#osszetevok'];

        if ( melyik == 2071 ) {
            for ( i = 0; i < mezok.length; i++ ) {
                $(mezok[i]).show();
                $(mezok[i].concat('label')).show();
            }
        } else if ( melyik == 2072 ) {
            for ( i = 0; i < mezok.length; i++ ) {
                $(mezok[i]).hide();
                $(mezok[i].concat('label')).hide();
            }
        }
    }

    function getFocsoportFromCsoport(ertek, mezo){
        $.ajax({
            type: "POST",
            url:"{{url('api/getFocsoportFromCsoport')}}",
            data: { id: ertek },
            success: function (response) {
                let resp = parseInt(response[0].tsz);
                if ( resp == 2071 ){
                    // Termék
                    getKovetekezoTermekCikkszam( ertek, mezo);
                } else if ( resp == 2072){
                    // Szolgáltatás
                    getKovetkezoSzolgaltatasCikkszam(mezo);
                }
                if (mezo != '#termek_cikkszam') {
                    fieldsVisible(resp);
                }
            },
            error: function (response) {
                console.log('Error:', response);
                swal( "Hiba",  "A api/getFocsoportFromCsoport hibát generált!",  "error" );
            }
        });
    }

</script>
