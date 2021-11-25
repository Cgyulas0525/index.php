<script type="text/javascript">

    $('#focsoport').on('change',function() {
        let focsoport = $(this).val();
        $('#cikkszam').val(null);
        if( focsoport ){
            $.ajax({
                type:"GET",
                url:"{{url('ddw/termekFocsoportCsoportDdw')}}?focsoport="+focsoport,
                success:function(res){
                    if(res){
                        $("#csoport").empty();
                        $("#csoport").append('<option></option>');
                        $.each(res,function(key,value){
                            $("#csoport").append('<option value="'+value.id+'">'+value.nev+'</option>');
                        });

                        if ( res.length == 1 ) {
                            $('#csoport').val(res[0].id);
                            getFocsoportFromCsoport($('#csoport').val(), '#cikkszam');
                        }

                    }else{
                        $("#csoport").empty();
                    }
                }
            });
        }else{
            $("#csoport").empty();
        }
    });

</script>
