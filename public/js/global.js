
  // auto fadeout for alert message
  $('div.alert').not('.alert-important').delay(6000).fadeOut(350);

  $('.alertclose').on('click',function(){
    $('.alert').hide();
  });

  $(".range").change(function(){
    $value=$(this).val();
    if($value)
    $url = $(this).data('url')+'&range='+$value;
    else
    $url = $(this).data('url');
    window.location = $url;
  });

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


  $(document).on('click', '.login_api', function(e){
      e.preventDefault();
      $('.alert').hide();
      $('.spinner-border').show();
      $email = $('input[name="email2"]').val();
      $password = $('input[name="password2"]').val();
      $_token = $('input[name="_token"]').val();

      $url = $(this).data('url');
        $.ajax({
          type : 'post',
          url : $url,
          data:{'email':$email,'password':$password,'_token':$_token},
          success:function(data){
            $('.spinner-border').hide();
            //console.log(data);
            d = JSON.parse(data);
            if(d.error){
              $('.alert-message').html(d.message);
              $('.alert').show();
            }else{
              $('.loginmodal').modal('toggle');
              setTimeout("location.reload(true);", 1);
            }
            
          }
        });
  });

  $(document).on('click', '.otp_submit', function(e){
      e.preventDefault();
      $('.alert').hide();
      $('.spinner-border').show();
      $sms_code = $('input[name="sms_code"]').val();
      $_token = $('input[name="_token"]').val();

      $url = $(this).data('url');
        $.ajax({
          type : 'post',
          url : $url,
          data:{'sms_code':$sms_code,'api':1,'_token':$_token},
          success:function(data){
            $('.spinner-border').hide();
            //console.log(data);
            d = JSON.parse(data);
            if(d.error){
              $('.alert-message').html(d.message);
              $('.alert').show();
            }else{
              $('.loginmodal').modal('toggle');
              setTimeout("location.reload(true);", 1);
            }
            
          }
        });
  });

  $(document).on('click', '.register_api', function(e){
      e.preventDefault();
      $('.spinner-border').show();
      $('.alert').hide();
      //console.log("register api");

      $name = $('input[name="name"]').val();
      $email = $('input[name="email"]').val();
      $phone = $('input[name="phone"]').val();
      $password = $('input[name="password"]').val();
      $repassword = $('input[name="repassword"]').val();
      $_token = $('input[name="_token"]').val();

      $error =0;

      if($name.length==0)
      {
        $('.alert-message').html("Kindly enter your name");
        $('.alert').show();
        $error =1;
      }

      if($email.length==0)
      {
        $('.alert-message').html("Kindly enter your email");
        $('.alert').show();
        $error =1;
      }

      if($phone.length==0)
      {
        $('.alert-message').html("Kindly enter the phone number");
        $('.alert').show();
        $error =1;
      }

      if($password!=$repassword)
      {
        $('.alert-message').html("Password and confirm password mismatch");
        $('.alert').show();
        $error =1;
      }

      if($password.length<8){
         $('.alert-message').html("Password cannot be less than 8 characters");
         $('.alert').show();
         $error =1;
      }

      if(!$error){
        $url = $(this).data('url');
        $.ajax({
          type : 'post',
          url : $url,
          data:{'name':$name,'email':$email,'phone':$phone,'password':$password,'_token':$_token},
          success:function(data){
            $('.spinner-border').hide();
            d = JSON.parse(data);
            if(d.error){
              $('.alert-message').html(d.message);
              $('.alert').show();
            }else{
              $('.register_form').hide();
              $('.otp_activation').show();
            }
            
          }
        });
      }else{
        $('.spinner-border').hide();
      }
      
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

    $(function(){
    $('.btn-error-report').on('click',function(e){
      e.preventDefault();
      $('.spinner-border').show();
      $name = $('input[name="name"]').val();
      $email = $('input[name="email"]').val();
      $qno = $('input[name="qno"]').val();
      $details = $.trim($(".details").val());
      $_token =  $('input[name="_token"]').val();
      $url = $('input[name="url"]').val();

      
      
      $.post( $url, {'name':$name,'email':$email,'qno':$qno,'details':$details,'_token':$_token},function( data ) {
        $( ".modal-body" ).html( data );
      });
      
    });
      
  });

  $('.view-more').on('click',function(e){
        $(this).hide();
          $('.test_block').show();
          e.preventDefault();
  });

  if($('.toast').length){
        $('.toast').toast({autohide:false});
          setTimeout(function () {
          $('.toast').toast('show');
        },2000);
      }

  
