<script type="text/javascript">
    function NumericInput(inp) {
        var numericKeys = '0123456789';

        // restricts input to numeric keys 0-9
        inp.addEventListener('keypress', function(e) {
            var event = e || window.event;
            var target = event.target;

            if (event.charCode == 0) {
                return;
            }

            if (-1 == numericKeys.indexOf(event.key)) {
                // Could notify the user that 0-9 is only acceptable input.
                event.preventDefault();
                return;
            }
        });

        // add the thousands separator when the user blurs
        inp.addEventListener('blur', function(e) {
            var event = e || window.event;
            var target = event.target;

            var tmp = target.value.replace(/,/g, '');
            var val = Number(tmp).toLocaleString('hu-HU');

            if (tmp == '') {
                target.value = '';
            } else {
                target.value = val;
            }
        });

        // strip the thousands separator when the user puts the input in focus.
        inp.addEventListener('focus', function(e) {
            var event = e || window.event;
            var target = event.target;
            var val = target.value.replace(/[,.]/g, '');

            target.value = val;
        });
    }
    
    function fieldChange(k, mezo, urlalap) {
        $(mezo+k).change(function(event){
            event.preventDefault();
            let id = parseInt($('#id'+k).val());
            let mennyiseg = parseInt($(mezo+k).val());
            var myurl = urlalap;
            myurl = myurl.replace(':id', id);
            myurl = myurl.replace(':mennyiseg', mennyiseg);
            $.ajax({
                type:'POST',
                enctype: 'multipart/form-data',
                url: myurl,
                contentType: false,
                processData: false,
                success:function(data){
                /* $('.alert-success').html(data.success).fadeIn('slow');
                   $('.alert-success').delay(3000).fadeOut('slow');*/
                }
            });
        });
        
    }

</script>