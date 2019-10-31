
  // auto fadeout for alert message
  $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

  // search data
  $('#search').on('keyup',function(){
    $value=$(this).val();
    $url = $(this).data('url');
    $.ajax({
      type : 'get',
      url : $url,
      data:{'search':true,'item':$value},
      success:function(data){
        $('#search-items').html(data);
      }
    });
  });

  $('#search2').on('keyup',function(){
    $value=$(this).val();
    $url = $(this).data('url');
    $.ajax({
      type : 'get',
      url : $url,
      data:{'search':true,'item2':$value},
      success:function(data){
        $('#search-items2').html(data);
      }
    });
  });


  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });

  $(function () {
    $('[data-toggle="popover"]').popover()
  });


  $(".hover-border").on({
    mouseenter: function () {
        //stuff to do on mouse enter
        $(this).addClass('border');
    },
    mouseleave: function () {
        //stuff to do on mouse leave
        $(this).removeClass('border');
    }
  });

  $(".hover-bg").on({
    mouseenter: function () {
        //stuff to do on mouse enter
        $(this).addClass('bg-shadow');
    },
    mouseleave: function () {
        //stuff to do on mouse leave
        $(this).removeClass('bg-shadow');
    }
  });


  
