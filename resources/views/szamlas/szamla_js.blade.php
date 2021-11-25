<script type="text/javascript">

    var SITEURL = "{{url('/')}}";

    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        var d = result.getDate();
        var m =  result.getMonth() + 1;
        m = m.toString().length == 1 ? '0'+m.toString() : m.toString();
        var y = result.getFullYear();
        result = (y + "-" + m + "-" + d);
        return result;
    }

    function datumAllitas(){
        var null_date = new Date(0);
        let fizetesiMod = $('#fizitesimod').val();
        let kelt = $('#kelt').val();
        if ( fizetesiMod != 0 && kelt != 0){
            if ( fizetesiMod == 2058 || fizetesiMod == 2060){
                $('#teljesites').val(kelt);
                $('#fizetesihatarido').val(kelt);
            }else{
                $('#teljesites').val(kelt);
                let fizhat = addDays(kelt, 8);
                $('#fizetesihatarido').val(fizhat);
            }
        }else{
            $('#teljesites').val(null_date);
            $('#fizetesihatarido').val(null_date);
        }
    }

    $('#fizitesimod').change(function(){
        datumAllitas();
    });

    $('#kelt').change(function(){
        datumAllitas();
    });

    $('#teljesites').change(function(){
    });

    $('#fizetesihatarido').change(function(){
    });

    RequiredBackgroundModify('.form-control')

</script>
