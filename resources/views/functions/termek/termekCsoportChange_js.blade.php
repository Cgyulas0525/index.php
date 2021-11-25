<script type="text/javascript">

    function termekCsoportChange() {
        $('#termek_csoport').change(function(){
            arSzamol('Termék');
            let ertek = $('#termek_csoport').val();
            if (ertek != 0) {
                getFocsoportFromCsoport( ertek, '#termek_cikkszam');
            }else{
                $('#termek_cikkszam').val(" ");
            }
        });
    }

</script>
