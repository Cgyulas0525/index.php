<script type="text/javascript">

    function arSzamol() {
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

                    console.log(response);

                    if ( response ){
                        let resp = parseInt(response[0].haszonkulcs);
                        ar = ar510Kerekit((beszar / mennyiseg) * ((100 + resp) / 100));
                        $('#ar').val(ar);
                    }
                },
                error: function (response) {
                    console.log('Error:', response);
                }
            });
        }
    }

</script>
