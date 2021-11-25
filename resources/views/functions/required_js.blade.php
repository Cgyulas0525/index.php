<script type="text/javascript">

    function RequiredBackgroundModify(selector) {
          var divs = document.querySelectorAll(selector);
          for (var k in divs) {
            if(divs[k].required){
               divs[k].setAttribute('style', 'background-color: yellow');
            }
          }
          return true;
      }
</script>
