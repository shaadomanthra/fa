


@if(isset($editor))
<script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>  
<script type="application/javascript" src="{{asset('js/script.js?new=2')}}"></script>  
<script type="application/javascript" src="{{asset('js/summernote/summernote-bs4.js')}}"></script>    
<script type="application/javascript" src="{{asset('js/jquery.form.js')}}"></script> 
<script type="application/javascript" src="{{asset('js/global.js')}}"></script>  


<script type="application/javascript">
    $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'Hello ! Write something...',
                tabsize: 2,
                height: 200,                // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: true,
                callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
    }
              });

            $('.summernote2').summernote({
              placeholder: 'Enter your response ... ',
              tabsize: 2,
                height: 300,                // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: true,
                toolbar: [],
                callbacks: {
                  onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                  }
                }

              });

            $('.summernote3').summernote({
              placeholder: 'Enter the question...',
              tabsize: 2,
                height: 200,                // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: true,
                toolbar: [
                  ['font', ['bold', 'italic', 'underline', 'clear']],
                  ['insert', [ 'picture' ]],
                  ['view', ['fullscreen']],
                ],
                callbacks: {
                  onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                  }
                }

              });

          });

      $(document).on("keyup", function(){
        var text = $(".summernote2").summernote("code");
        text = text.replace(/<p[^>]*>/g, '').replace(/<\/p>/g, ' ');
        var words = countWords(text.replace(/<\/?[^>]+(>|$)/g, ""));
        //Update Count value
        $(".word-count").text(words);

      });

        $('#write').submit(function() {
              if ($('input[name=accept]:checkbox').is(':checked')) {

              } else {
                  alert('Please select the checkbox to accept the terms.');
                  return false;
              }
        });

      function countWords(s){
        s = s.replace(/(^\s*)|(\s*$)/gi,"");
        s = s.replace(/[ ]{2,}/gi," ");
        s = s.replace(/\n /,"\n");
        return s.split(' ').length;
      }



</script>
@elseif(isset($reading))
<script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>  
<script type="application/javascript" src="{{asset('js/script.js?new=1')}}"></script>  
<script type="application/javascript">
    $( document ).ready(function() {
    var height = $( window ).height();
    var width = $( window ).width();
    if($('.navbar').length)
    var nav = $('.navbar').height();
    else
      var nav = 0;
    var bottom = $('.bottom-qno').height();
    var h = height-nav-70;

    if(width<400){
       $('.rightpanel').css('height',h/2);
        $('.leftpanel').css('height',h/4);

    }
    else if(width<768){
       $('.rightpanel').css('height',3*h/4);
        $('.leftpanel').css('height',h/4);
    }
    else{
         $('.panel').css('height',h);
    }
   

    $('.pallete-control').on('click',function(){
        var height = $( window ).height();
        var nav = $('.navbar').height();
        var bottom = $('.pallete').height();
        var h = height - nav  - 60;
        $('.bottom-scroll').slideToggle(function(){

          if($('.bottom-scroll').is(':visible'))
          $('.angle').html('<i class="fa fa-angle-double-down"></i>');
          else
            $('.angle').html('<i class="fa fa-angle-double-up"></i>');
        });
       
    });

    $(".bottom-pno").click(function() {
            $class = ".r"+$(this).data('id'); 
            $('.r').hide();
            $($class).show();
            
            $(".leftpanel").animate({
              scrollTop: 0
            }, 500);
            
        });
    
    $(".button").click(function() {
            $id = $(this).data('id');
            $class = ".r"+$id; 
            $('.r').hide();
            $($class).show();

            $('.section-number').html($id);
            for($k=1;$k<10;$k++){

              
              if(!$('.r'+$k).length)
                break;
              $last = $k;
            }

            for($m=1;$m<=$last;$m++){
              if($id == $m){
                $('.prev').data('id',$m-1);
                $('.next').data('id',$m+1);


                if($id == 1){
                  $('.prev').hide();
                  $('.next').show();
                }

                else if($id==$last){
                  $('.next').hide();
                  $('.prev').show();
                }
                else{
                  $('.next').show();
                  $('.prev').show();
                }

              }
            }

            $(".leftpanel").animate({
              scrollTop: 0
            }, 50);
            $(".rightpanel").animate({
              scrollTop: 0
            }, 500);
            
        });
    $(".bottom-sno").click(function() {
            $id = "#"+$(this).data('id'); 
            $section_number = $(this).data('section')+1;
            $section = ".r"+$section_number; 
          

            if(!$($section).is(':visible')){
              $('.r').hide();
              $($section).show();

              $(".leftpanel").animate({
                scrollTop: 0
                }, 50);

            $('.section-number').html($section_number);
            for($k=1;$k<10;$k++){

              
              if(!$('.r'+$k).length)
                break;
              $last = $k;
            }

            for($m=1;$m<=$last;$m++){
              if($section_number == $m){
                $('.prev').data('id',$m-1);
                $('.next').data('id',$m+1);


                if($section_number == 1){
                  $('.prev').hide();
                  $('.next').show();
                }

                else if($section_number==$last){
                  $('.next').hide();
                  $('.prev').show();
                }
                else{
                  $('.next').show();
                  $('.prev').show();
                }

              }
            }

              if(Math.sign($('#0').offset().top)<0)
                $h = $('#0').offset().top*(-1) + $($id).offset().top + 10 ;
              else
                $h = $($id).offset().top -90;
              $(".rightpanel").animate({
                scrollTop: $h 
                }, 1000);
              
            }else{
              if(Math.sign($('#0').offset().top)<0)
                $h = $('#0').offset().top*(-1) + $($id).offset().top + 10 ;
              else
                $h = $($id).offset().top -90;
              $(".rightpanel").animate({
                scrollTop: $h 
                }, 1000);
            }
            
            
        });

      $('.input').on('input',function(e){
            var value = $(this).val();
            var id = '.s'+$(this).data('id');
            if(value.length){
                $(id).addClass('answered');
            }else{
                $(id).removeClass('answered');
            }
        });
});
</script>
@elseif(isset($player))
<script type="application/javascript" src="{{asset('js/player.js')}}"></script>
<script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>  
<script type="application/javascript" src="{{asset('js/bootstrap.bundle.js')}}"></script>
<script type="application/javascript" src="{{asset('js/global.js')}}"></script>  

<script type="application/javascript">
    $(document).ready(function(){
        const controls = [// Restart playback
        'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'pip', 'airplay', 'fullscreen',]
        const player = new Plyr('audio', { controls });

        window.player = player;

          // Bind event listener
          function on(selector, type, callback) {
            if(document.querySelector(selector))
            document.querySelector(selector).addEventListener(type, callback, false);
          }

        $(".play").click(function() {
            $seek = $(this).data('seek');
            player.stop();
            player.forward($seek);
            player.play();
        });

        $(".forward").click(function() {
            player.forward();
        });
        $(".backward").click(function() {
            player.rewind();
        });


        $(".sno").click(function() {
            $id = "#"+$(this).data('id'); 
            $([document.documentElement, document.body]).animate({
            scrollTop: $($id).offset().top - 130
        }, 1000);
        });

        $(".qdata").hide();
        $(".qshow").click(function() {
            $(".qdata").slideToggle(function(){
              if($('.qdata').is(':visible'))
          $('.angle').html('<i class="fa fa-angle-double-down"></i>');
          else
            $('.angle').html('<i class="fa fa-angle-double-up"></i>');
            });
        });

        $('.input').on('input',function(e){
            var value = $(this).val();
            var id = '.s'+$(this).data('id');
            if(value.length){
                $(id).addClass('answered');
            }else{
                $(id).removeClass('answered');
            }
        });  

    });     
</script>
@else
<script src="{{asset('js/script.js?new=1')}}" type="application/javascript"></script>  
@endif

@if(isset($grammar))
<script type="application/javascript">
    $(".td_option").click(function() {
        $id = $(this).data('id');
        $option = $(this).data('option');
        $group = $(this).data('group');

        if(!$(this).hasClass('td_answered'))
        {
          $('.td_'+$id+'_'+$group).removeClass('td_answered');
          $('.'+$id+'_'+$group).prop("checked",false);
          $('.'+$id+'_'+$option).prop("checked", true);
          $(this).addClass('td_answered');
          $('.s'+$id).addClass('answered');
        }else{
          $(this).removeClass('td_answered');
          $('.'+$id+'_'+$option).prop("checked", false);
          var options = ["A","B","C","D",'E',"F","G","H","I"];
          $isChecked = false;
          options.forEach(function(item, index, arr){
              if($('.'+$id+'_'+item).prop("checked"))
                $isChecked = true;
          });
          if(!$isChecked)
            $('.s'+$id).removeClass('answered');
        }
    });

    $('.sentence').on('click',function(){
      $id = $(this).data('id');
      var sno = '.s'+$(this).data('id');
      $('.sentence_'+$id).removeClass('sentence_selected');
      $(this).addClass('sentence_selected');
      $('.sentence_textarea').html($(this).text().trim());
      $('.sentence_input').val($(this).text().trim());
      $(sno).addClass('answered');
    });

</script>
@endif
@if(isset($gre))
<script type="application/javascript">

    $('.input_').on('input',function(e){
            var value = $(this).val();

            $id = $(this).data('id');
            $qno = $id;
            $group = $(this).data('group');
            $option = $(this).data('option');
            $section = $('.greblock_'+$id).data('section');
            $sno = $('.greblock_'+$id).data('sno');

            if(value.length){
              $('.r_'+$section+'_'+$qno).html('<span class="badge badge-success">Answered</span>');
            }else{
              $('.r_'+$section+'_'+$qno).html('<span class="badge badge-secondary">Not answered</span>');
            }
        });  

    $(".td_option").click(function() {
        $id = $(this).data('id');
        $qno = $id;
        $group = $(this).data('group');
        $option = $(this).data('option');
        $section = $('.greblock_'+$id).data('section');
        $sno = $('.greblock_'+$id).data('sno');

        if(!$(this).hasClass('td_answered'))
        {
          $('.td_'+$id+'_'+$group).removeClass('td_answered');
          $('.'+$id+'_'+$group).prop("checked",false);
          $('.'+$id+'_'+$option).prop("checked", true);
          $(this).addClass('td_answered');
          $('.s'+$id).addClass('answered');
          $('.r_'+$section+'_'+$qno).html('<span class="badge badge-success">Answered</span>');

        }else{
          $(this).removeClass('td_answered');
          $('.'+$id+'_'+$option).prop("checked", false);
          var options = ["A","B","C","D",'E',"F","G","H","I"];
          $isChecked = false;
          options.forEach(function(item, index, arr){
              if($('.'+$id+'_'+item).prop("checked"))
                $isChecked = true;
          });
          if(!$isChecked){
            $('.s'+$id).removeClass('answered');
            $('.r_'+$section+'_'+$qno).html('<span class="badge badge-secondary">Not answered</span>');
          }
        }
    });

    $('.sentence').on('click',function(){

      $id = $(this).data('id');
      $qno = $id;
      var sno = '.s'+$(this).data('id');
      $section = $('.sentence_input_'+$id).data('section');
      
      $('.sentence_'+$id).removeClass('sentence_selected');
      $(this).addClass('sentence_selected');
      $('.sentence_textarea').html($(this).text().trim());
      $('.sentence_input').val($(this).text().trim());
      $('.r_'+$section+'_'+$qno).html('<span class="badge badge-success">Answered</span>');
    });

    /* show/hide time */
    $('.hide_time').on('click',function(){
        $('#timer').toggle();
        if($('#timer').is(':visible'))
        {
            $('.hide_time').html('<i class="fa fa-minus-circle"></i> Hide Time');
        }else{
            $('.hide_time').html('<i class="fa fa-clock-o"></i> Show Time');
        }
    });

    $('.review_qno').on('click',function(e){
        $qno = $(this).data('qno');
        $sno = $(this).data('sno');
        $sec_current = $('.gre_mark').data('section');
        $section = $('.greblock_'+$qno).data('section');
        $mark = $('.greblock_'+$qno).data('mark');

        if($sec_current == $section){
        if($qno){
            $('.gre_qno').html($sno);
           $('.gre_section').html($section);
            $review = '#review_'+$section;
            $('.gre_review').data('target',$review);

            $('.qblock').hide();
            $('.greblock_'+$qno).show();

            $qno = $qno - 1;
            //update the navbar
            if($('.greblock_'+$qno).length){
              $('.gre_next').data('qno',($qno+2));
              $(this).data('qno',$qno);
              $('.gre_mark').data('qno',$qno+1);
              if($('.gre_next').data('qno'))
                $('.gre_next').removeClass('disabled');
            }
            else{
              $('.gre_next').data('qno',($qno+2));
              $(this).data('qno',0);
              $('.gre_mark').data('qno',$qno+1);
              $(this).addClass('disabled');
            }

            $('.gre_mark').data('section',$section);
            if($mark==0){
              $('.gre_mark').data('mark',0);
              $('.mark-icon').html('<i class="fa fa-square-o "></i>');
            }else{
              $('.gre_mark').data('mark',1);
              $('.mark-icon').html('<i class="fa fa-check-square-o "></i>');
            }
        }
        }else{
            $('.gre_prev').addClass('disabled');
        }

        $section = $('.gre_mark').data('section');
        $review = '#review_'+$section;

        $($review).modal('toggle');
        e.preventDefault();

    });

    /* Review Button */
    $('.gre_prev').on('click',function(e){
        $qno = $(this).data('qno');
        $sec_current = $('.gre_mark').data('section');
        $section = $('.greblock_'+$qno).data('section');
        $sno = $('.greblock_'+$qno).data('sno');
        $mark = $('.greblock_'+$qno).data('mark');

        if($sec_current == $section){
        if($qno){
            $('.gre_qno').html($sno);
           $('.gre_section').html($section);
            $review = '#review_'+$section;
            $('.gre_review').data('target',$review);

            $('.qblock').hide();
            $('.greblock_'+$qno).show();

            $qno = $qno - 1;
            //update the navbar
            if($('.greblock_'+$qno).length){
              $('.gre_next').data('qno',($qno+2));
              $(this).data('qno',$qno);
              $('.gre_mark').data('qno',$qno+1);
              if($('.gre_next').data('qno'))
                $('.gre_next').removeClass('disabled');
            }
            else{
              $('.gre_next').data('qno',($qno+2));
              $(this).data('qno',0);
              $('.gre_mark').data('qno',$qno+1);
              $(this).addClass('disabled');
            }

            $('.gre_mark').data('section',$section);
            if($mark==0){
              $('.gre_mark').data('mark',0);
              $('.mark-icon').html('<i class="fa fa-square-o "></i>');
            }else{
              $('.gre_mark').data('mark',1);
              $('.mark-icon').html('<i class="fa fa-check-square-o "></i>');
            }
        }
        }else{
            $('.gre_prev').addClass('disabled');
        }
    });


    $('.gre_next').on('click',function(e){
        $qno = $(this).data('qno');
        $sec_current = $('.gre_mark').data('section');
        $section = $('.greblock_'+$qno).data('section');
        $sno = $('.greblock_'+$qno).data('sno');
        $mark = $('.greblock_'+$qno).data('mark');

        if($sec_current!=$section){
          $('#section_submit').modal();
          e.preventDefault();
        }else{
           if($qno){
              $('.gre_qno').html($sno);
              $('.gre_section').html($section);
              $review = '#review_'+$section;
              $('.gre_review').data('target',$review);
              

              $('.qblock').hide();
              $('.greblock_'+$qno).show();
               $qno = $qno +1;
              //update the navbar
              if($('.greblock_'+$qno).length){
                $('.gre_prev').data('qno',($qno-2));
                $('.gre_next').data('qno',$qno);
                $('.gre_mark').data('qno',$qno-1);
                if($qno-2!=0)
                $('.gre_prev').removeClass('disabled');
              }
              else{
                $('.gre_prev').data('qno',($qno-2));

                $('.gre_next').data('qno',0);
                $('.gre_mark').data('qno',$qno);
                $(this).addClass('disabled');
              }

              $('.gre_mark').data('section',$section);
              if($mark==0){
                $('.gre_mark').data('mark',0);
                $('.mark-icon').html('<i class="fa fa-square-o "></i>');
              }else{
                $('.gre_mark').data('mark',1);
                $('.mark-icon').html('<i class="fa fa-check-square-o "></i>');
              }
          }

        }

       
    });

    $('.btn-submit-section').on('click',function(e){
        $section = $('.gre_mark').data('section')+1;

        //replace section count
        $('.gre_sec').hide();
        $('.sec_'+$section).show();

        $qno = $('.section_data_'+$section).data('qno');
        $sno = $('.greblock_'+$qno).data('sno');
        $mark = $('.greblock_'+$qno).data('mark');
        $('.gre_prev').addClass('disabled');
        $('#section_submit').modal('toggle'); 
        if($qno){
              $('.gre_qno').html($sno);
              $('.gre_section').html($section);
              $review = '#review_'+$section;
              $('.gre_review').data('target',$review);
              

              $('.qblock').hide();
              $('.greblock_'+$qno).show();
               $qno = $qno +1;
              //update the navbar
              if($('.greblock_'+$qno).length){
                $('.gre_prev').data('qno',($qno-2));
                $('.gre_next').data('qno',$qno);
                $('.gre_mark').data('qno',$qno-1);
                
              }
              else{
                $('.gre_prev').data('qno',($qno-2));
                $('.gre_next').data('qno',0);
                $('.gre_mark').data('qno',$qno);
                $(this).addClass('disabled');
              }

              $('.gre_mark').data('section',$section);
              if($mark==0){
                $('.gre_mark').data('mark',0);
                $('.mark-icon').html('<i class="fa fa-square-o "></i>');
              }else{
                $('.gre_mark').data('mark',1);
                $('.mark-icon').html('<i class="fa fa-check-square-o "></i>');
              }
          }
    });

    $('.gre_mark').on('click',function(){
        $mark = $(this).data('mark');
        $qno = $(this).data('qno');
        $section = $(this).data('section');

        if($mark==1){
          $('.gre_mark').data('mark',0);
          $('.gre_mark').data('mark',0);
          $('.m_'+$section+'_'+$qno).html('');
          $('.mark-icon').html('<i class="fa fa-square-o "></i>');

        }else{
          $('.gre_mark').data('mark',1);
          $('.greblock_'+$qno).data('mark',1);

          $('.m_'+$section+'_'+$qno).html('<i class="fa fa-check-circle"></i>');
          $('.mark-icon').html('<i class="fa fa-check-square-o "></i>');
        }
    });


    $('.gre_review').on('click',function(e){
      
      $section = $('.gre_mark').data('section');
      $review = '#review_'+$section;
  
      $($review).modal();
      e.preventDefault();
    });

    $('.gre_submit').on('click',function(e){
      $('#test_submit').modal();
      e.preventDefault();
    });

    $('.gre_exit_section').on('click',function(e){
      $section = $('.gre_mark').data('section')+1;
      if($('.section_data_'+$section).length)
        $('#section_submit').modal();
      else
        $('#test_submit').modal();
      e.preventDefault();
    });

</script>
@endif

@if(isset($timer))
@if($time)
<script type="application/javascript">
// Set the date we're counting down to
@if(isset($time))
  var countDownDate = addMinutes(new Date(),{{ ($time) }});
@endif

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  var t="" ;
  if(hours!=0)
    t = hours+"h ";
  if(minutes !=0)
    t = t+minutes+"m ";
  if(seconds !=0)
    t = t+seconds+"s ";

  // Display the result in the element with id="demo"
  document.getElementById("timer").innerHTML =  t;

  document.getElementById("timer2").innerHTML =  t;

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "EXPIRED";
    document.getElementById("timer2").innerHTML = "EXPIRED";

    alert('The Test time has expired. ');
    $('.test').submit();

  }
}, 1000);

function addMinutes(date, minutes) {
    return new Date(date.getTime() + minutes*60000);
}

/* prevent copy */

$('body').bind('copy paste',function(e) {
    e.preventDefault(); return false; 
});

$(document).ready(function () {
    //Disable full page
    $("body").on("contextmenu",function(e){
        return false;
    });
    
    //Disable part of page
    $("#id").on("contextmenu",function(e){
        return false;
    });
});

  
/* prevent refresh */
var btn = document.getElementById('submit'),
    clicked = false;

btn.addEventListener('click', function () {
  clicked = true;
});

window.onbeforeunload = function (e) {

  if(!clicked) {
    return 'If you resubmit this page, progress will be lost.';
  }
};



</script>
@endif
@endif


@if(isset($datetimepicker))

<script src="{{ asset('js/datetimepicker/build/jquery.datetimepicker.full.min.js') }}"></script>
<script>/*
window.onerror = function(errorMsg) {
  $('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2019/08/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
  $("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
  $.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker();
/*
$('#datetimepicker').datetimepicker({value: {{date("Y")}}+'/'+{{date("m")}}+'/'+{{date("d")}}+' 16:03', step:10});  */
 


</script>
@endif
