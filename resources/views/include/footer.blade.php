

<!-- <div class="loader-overlay dn">
	<div class="loader"><img src="img/main-loader.svg"></div>
</div> -->
<footer class="custom_footer">
    <div class="custom_container">
    <p >© Copyright 2023. All rights reserved. Powered by <img src="images/pawprint.png" alt="Pawprint"> myResearcher.com</p>
    </div>
   </footer>
   @yield('script')
    <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/jquery.tmpl.min.js')}}"></script>
  <script src="{{asset('js/dataportal.js')}}"></script>
  <script src="{{asset('js/serial.js')}}"></script> 
 <script src="{{asset('js/redirect.js')}}"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  
  <script>
  
$(document).ready(function(){
  $('.prior_click').click(function(){
    $(this).closest('.economic_cards').addClass('active');
  });
  $('.remove_list').click(function(){
    $(this).closest('.economic_cards').removeClass('active');
  });
});
      </script>
      <script>
$(document).ready(function(){
	$(".navigation li.active").trigger('click');
});
</script>
  </body>
</html>