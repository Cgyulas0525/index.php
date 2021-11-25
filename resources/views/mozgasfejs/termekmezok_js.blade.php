<script type="text/javascript">

    function ujTermekMezok(check) {

        let mezok = [
            '#termek_nev',
            '#termek_csoport',
            '#termek_partner',
            '#termek_me',
            '#termek_cikkszam',
            '#termek_minmenny',
            '#termek_mennyiseg',
            '#termek_beszar',
            '#termek_ar',
            '#termek_nevlabel',
            '#termek_csoportlabel',
            '#termek_partnerlabel',
            '#termek_cikkszamlabel',
            '#termek_melabel',
            '#termek_minmennylabel',
            '#termek_mennyiseglabel',
            '#termek_beszarlabel',
            '#termek_arlabel',
            '#glutenmentes',
            '#laktozmentes',
            '#tejmentes',
            '#tojasmentes',
            '#cukormentes',
            '#vegan',
            '#glutenmenteslabel',
            '#laktozmenteslabel',
            '#tejmenteslabel',
            '#tojasmenteslabel',
            '#cukormenteslabel',
            '#veganlabel',
            '#energiakj', '#energiakcal', '#zsir', '#telitett', '#szenhidrat', '#cukor',
            '#rost', '#feharje', '#so', '#osszetevok',
            '#energiakjlabel', '#energiakcallabel', '#zsirlabel', '#telitettlabel', '#szenhidratlabel', '#cukorlabel',
            '#rostlabel', '#feharjelabel', '#solabel', '#osszetevoklabel'
        ]

        if (check == false){
            $('#termek').val(null);
            $('#termek').hide();
            $('#termeklabel').hide();

            for ( i = 0; i < mezok.length; i++ ) {
                $(mezok[i]).show();
            }

            $('#termek_nev').attr("required", "true");
            $('#termek_csoport').attr("required", "true");
            $('#termek_partner').attr("required", "true");
        } else {
            $('#termek').show();
            $('#termeklabel').show();

            for ( i = 0; i < mezok.length; i++ ) {
                $(mezok[i]).hide();
                $(mezok[i]).val(null);
            }

            $('#termek_nev').removeAttr("required");
            $('#termek_csoport').removeAttr("required");
            $('#termek_partner').removeAttr("required");
        }
    }

</script>
