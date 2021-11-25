<script type="text/javascript">

    function mezoChange(mezo) {
        let checkBox = document.getElementById(mezo);
        mezo = '#'.concat(mezo);
        if (checkBox.checked == true) {
            $(mezo).val(1);
        } else {
            $(mezo).val(0);
        }
    }

    function mezoCheck(mezo, mire) {
        let checkBox = document.getElementById(mezo);
        checkBox.checked = mire;
    }

    function fieldCheck(mezok) {
        for ( i = 0; i < mezok.length; i++ ) {
            if ($('#'.concat(mezok[i])).val() == 0) {
                mezoCheck( mezok[i], false);
            }
            if ($('#'.concat(mezok[i])).val() == 1) {
                mezoCheck( mezok[i], true);
            }
        }
    }



</script>
