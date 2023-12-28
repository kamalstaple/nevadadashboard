
$(document).ready(function(){
    $('.economic_cards').click(function(){
      $(this).addClass('active');
    });
    $('.remove_list').click(function(event){
      event.stopPropagation();
      $(this).closest('.economic_cards').removeClass('active');
    });
  });
   
  
  $(document).ready(function(){
      $(".navigation li.active").trigger('click');
  });