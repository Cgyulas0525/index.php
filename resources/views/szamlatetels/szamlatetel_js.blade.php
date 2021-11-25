<script type="text/javascript">

    $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
    });

    var SITEURL = "{{url('/')}}";

    function afaBrutto() {
        var afaid = $('#afaszaz').val();
        var netto = $('#netto').val();
        if (afaid != 0 && netto != 0) {
            $.ajax({
                type: "POST",
                url: SITEURL + '/api/getAfaSzazalek',
                data: "&id=" + afaid,
                success: function (response) {
                    let resp = parseInt(response[0].afaszaz) / 100;
                    let afa = Math.round(resp * parseInt(netto)).toFixed(0);
                    let brutto = parseInt(netto) + parseInt(afa);
                    $('#afa').val(afa);
                    $('#brutto').val(brutto);
                },
                error: function (response) {
                    console.log('Error:', response);
                }
            });
        }else{
            $('#afa').val(0);
            $('#brutto').val(0);
        }
    }

    $('#afaszaz').change(function(){
        afaBrutto();
    });

    $('#netto').change(function(){
        afaBrutto();
    });

    RequiredBackgroundModify('.form-control')
</script>
