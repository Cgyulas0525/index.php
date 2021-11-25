<script type="text/javascript">

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


</script>
