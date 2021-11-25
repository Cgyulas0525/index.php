<script type="text/javascript">

    function modulChange() {
        $('#modul_id').change(function () {
            let SITEURL = "{{url('/')}}";
            let modul = $('#modul_id').val();
            if (modul != 0) {
                window.location.href = SITEURL + modul;
            }
        });
    }

</script>
