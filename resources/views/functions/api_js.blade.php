<script type="text/javascript">

    function afaSzazalek(afaKod) {
        let afaSzazalek = 0;
        if ( afaKod == 2081 || afaKod == 2084){
            afaSzazalek = 0;
        }else if ( afaKod == 2082){
            afaSzazalek = 5;
        }else if ( afaKod == 2085){
            afaSzazalek = 18;
        }else if (afaKod == 2083){
            afaSzazalek = 27;
        }
        return afaSzazalek;
    }

    function arSzamol(melyik) {
        let beszar = $('#beszar').val();
        let csoport = $('#csoport').val();
        let mennyiseg = $('#mennyiseg').val() != 0 ? $('#mennyiseg').val() : 1;
        if ( beszar != 0 && csoport != 0 && mennyiseg != 0) {
            let ar = 0;
            $.ajax({
                type: "POST",
                url: '{{url('api/getFocsoportFromCsoport')}}',
                data: "&id=" + csoport,
                success: function (response) {
                    if ( response ){
                        let resp = parseInt(response[0].haszonkulcs);
                        ar = ar510Kerekit((beszar / mennyiseg) * ((100 + resp) / 100));
                        if ( melyik == 'Termék' ) {
                            $('#termek_ar').val(ar);
                            $('#termek_beszar').val((beszar / mennyiseg).toFixed(0))
                        }
                        if ( melyik != 'Termék' ) {
                            $('#ar').val(ar);
                        }
                    }
                },
                error: function (response) {
                    console.log('Error:', response);
                }
            });
        }

        function ar510Kerekit(ertek) {
            let ar = ertek.toFixed(0).toString();
            let hossz = ar.length;
            let eleje = parseInt(ar.substr(0, hossz - 1));
            let vege  = parseInt(ar.substr( hossz - 1, hossz));

            if (vege > 0 && vege < 3) {
                vege = 0;
            }

            if ( vege > 2 && vege < 8) {
                vege = 5;
            }

            if ( vege > 7 ) {
                vege = 0;
                eleje = eleje + 1;
            }

            return parseInt(eleje.toString().concat(vege.toString()));
        }

    }

</script>
