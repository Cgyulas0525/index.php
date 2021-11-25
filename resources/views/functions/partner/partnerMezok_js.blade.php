<script type="text/javascript">

    function partnerMezok() {
        let mezok = [
            '#partner_nevlabel', '#partner_nev', '#partner_adoszamlabel', '#partner_adoszam', '#partner_bankszamlalabel',
            '#partner_bankszamla', '#partner_iszlabel', '#partner_isz', '#partner_telepuleslabel', '#partner_telepules',
            '#partner_cimlabel', '#partner_cim', '#partner_tipuslabel', '#partner_tipus', '#partner_emaillabel',
            '#partner_email', '#partner_telefonszamlabel', '#partner_telefonszam'
        ]
        return mezok;
    }

    function partnerFields(mire, partnerMezok) {
        if (mire) {
            $('#partner').val(null);
            $('#partner').prop('required', false);
            $('#partner').hide();
        } else {
            $('#partner').prop('required', true);
            $('#partner').show();
            $('#partner').focus();
        }
        for ( i = 0; i < partnerMezok.length; i++ ) {
            if (mire) {
                $(partnerMezok[i]).show();
            } else {
                $(partnerMezok[i]).val(null);
                $(partnerMezok[i]).hide();
            }
        }
        if (mire) {
            $('#partner_nev').focus();
        }
    }


</script>
