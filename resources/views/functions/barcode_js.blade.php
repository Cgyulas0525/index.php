<script type="text/javascript">

    function vanEIlyenBarcode(barcode) {
        if (barcode != 0) {
            var barcode = barcodeReplace(barcode);
            $("#barcode").val(barcode);
            $.ajax({
                type: "GET",
                url:"{{url('api/vanEBarcode')}}",
                data: { barcode: barcode },
                success: function (response) {
                    if(response != 0){
                        swal( "Hiba",  "Van már ilyen vonalkódú tétel!",  "error" );
                        $("#barcode").val(null);
                        $('#barcode').focus();
                    }
                },
                error: function (response) {
                    console.log('Error:', response);
                    swal( "Hiba",  "A api/vanEBarcode hibát generált!",  "error" );
                }
            });
        }

    }

    function barcodeReplace(barcode) {
        let vonalkod;
        vonalkod = barcode.replace(/[ö]/g, '0');
        vonalkod = vonalkod.replace(/[Ö]/g, '0');
        vonalkod = vonalkod.replace(/[ü]/g, '-');
        vonalkod = vonalkod.replace(/[Ü]/g, '-');

        return vonalkod;
    }

    function getBarcodeTermek(barcode) {
        if (barcode != 0) {
            var barcode = barcodeReplace(barcode);
            $("#barcode").val(barcode);
            $.ajax({
                type: "GET",
                url:"{{url('api/getBarcodeTermek')}}",
                data: { barcode: barcode },
                success: function (response) {
                    if(response != 0){
                        return response.id;
                    } else {
                        swal( "Hiba",  "Nincs ilyen vonalkódú tétel!",  "error" );
                        $("#barcode").val(null);
                        $('#barcode').focus();
                    }
                },
                error: function (response) {
                    console.log('Error:', response);
                    swal( "Hiba",  "A api/vanEBarcode hibát generált!",  "error" );
                }
            });
        }
    }


</script>
