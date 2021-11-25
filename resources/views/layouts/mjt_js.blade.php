<script>
    $('#country').change(function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
               type:"GET",
               url:"{{url('api/get-state-list')}}?country_id="+countryID,
               success:function(res){
                if(res){
                    $("#state").empty();
                    $("#state").append('<option></option>');
                    $.each(res,function(key,value){
                        var option = "<option value='"+value.id+"'>"+value.nev+"</option>";
                        $("#state").append(option);
                    });

                }else{
                   $("#state").empty();
                }
               }
            });
        }else{
            $("#state").empty();
            $("#city").empty();
        }
    });

    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
               type:"GET",
               url:"{{url('api/get-city-list')}}?state_id="+stateID,
               success:function(res){
                if(res){
                    $("#city").empty();
                    $("#city").append('<option></option>');
                    $.each(res,function(key,value){
                        $("#city").append('<option value="'+value.id+'">'+value.nev+'</option>');
                    });

                }else{
                   $("#city").empty();
                }
               }
            });
        }else{
            $("#city").empty();
        }
    });
</script>
