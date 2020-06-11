

@if(isset($code))
<!-- Codemirror-->
<script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>  
<script src="{{asset('js/codemirror/lib/codemirror.js')}}"></script>  
<script src="{{asset('js/codemirror/mode/xml/xml.js')}}"></script>  
<script src="{{asset('js/codemirror/mode/javascript/javascript.js')}}"></script> 
<script src="{{asset('js/codemirror/mode/clike/clike.js')}}"></script>  
<script src="{{asset('js/codemirror/addon/display/autorefresh.js')}}"></script>  
<script src="{{asset('js/codemirror/mode/markdown/markdown.js')}}"></script>  

<script type="text/javascript">
$(document).ready(function() {
  var options = {
          lineNumbers: true,
          styleActiveLine: true,
          matchBrackets: true,
          autoRefresh:true,
          mode: "text/x-c++src",
          theme: "monokai",
          indentUnit: 4
        };
  if(document.getElementById("code"))
    var editor = CodeMirror.fromTextArea(document.getElementById("code"), options);
});
</script>
@endif


@if(isset($editor))
<script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>  
<script type="application/javascript" src="{{asset('js/script.js?new=11')}}"></script>  
<script type="application/javascript" src="{{asset('js/summernote/summernote-bs4.js')}}"></script>    
<script type="application/javascript" src="{{asset('js/jquery.form.js')}}"></script> 
<script type="application/javascript" src="{{asset('js/global.js?new=4')}}"></script>  

<script type="application/javascript">
$(document).ready(function() {
    $(document).on("keyup", function(){
       
        if($("#phone").length){

            var phone = $("#phone").val();
            var url = $("#phone").data('url');
            var type= $(".form").data('type');
            var edit = $("#phone").data('edit');
   
            if(type=='create')
            if(phone.length==10){
              $.ajax({
               type: "GET",
               url: url,
               data: {"phone":phone}, // serializes the form's elements.
               success: function(data)
               {
                  
                  d=jQuery.parseJSON(data);
                  console.log(d);
                  if(d.id){
                    $('.alert').slideToggle();
                    $('.phonenumber').text(phone);
                    $('.name').text(d.name);
                    $('.userlink').attr('href',edit+'/'+d.id+'/edit');
                  }else{
                    $('.alert').slideUp();
                  }
                  
               }
             });
            }

        }

      });


});

</script>

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

            $('.summernote4').summernote({
              placeholder: 'Enter your response ... ',
              tabsize: 2,
                height: 100,                // set editor height
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
        if($(".summernote2").length){
        var text = $(".summernote2").summernote("code");
        text = text.replace(/<p[^>]*>/g, '').replace(/<\/p>/g, ' ');
        var words = countWords(text.replace(/<\/?[^>]+(>|$)/g, ""));
        //Update Count value
        $(".word-count").text(words);
      }


      if($(".summernote4").length){
        var text = $(".summernote4").summernote("code");
        text = text.replace(/<p[^>]*>/g, '').replace(/<\/p>/g, ' ');
        var words = countWords(text.replace(/<\/?[^>]+(>|$)/g, ""));
        //Update Count value
        $(".word-count").text(words);
      }

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
<script type="application/javascript" src="{{asset('js/script.js?new=11')}}"></script>  
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
            $id = parseInt($(this).data('id'));
            $class = ".r"+$id; 
            $('.r').hide();
            $($class).show();
            $idp = $id+1;
             $content = parseInt($($class).data('content'));

            if($content){
              $('.leftblock').show();
            }
            else{
              $('.leftblock').hide();
            }

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
          
            $content = parseInt($($section).data('content'));

            if($content){
              $('.leftblock').show();
            }
            else{
              $('.leftblock').hide();
            }

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
<script type="application/javascript" src="{{asset('js/global.js?new=4')}}"></script>  

<script type="application/javascript">
  @if(isset($test))
  @if($test->testtype->name!='DUOLINGO')
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

        if($(".stop").length)
        $(".stop").click(function() {
            player.stop();
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

    @endif 
    @endif 
</script>
@else
<script src="{{asset('js/script.js?new=11')}}" type="application/javascript"></script>  
@endif

@if(isset($grammar))

<script src="{{asset('js/circular.js')}}" type="application/javascript"></script>
<script type="application/javascript">

  



  @foreach(["a","b","c","d","e","f","g","h","i","j",'k',"l"] as $item)

    if($('#playerContainer_{{$item}}').length){
      audioPath = $('#playerContainer_{{$item}}').data('src');
      console.log(audioPath);
      var cap = new CircleAudioPlayer({
        audio: audioPath,
        size: 120,
        borderWidth: 4,
        size:50,
      });
      cap.appendTo(playerContainer_{{$item}});
    }

  @endforeach

  if($('#playerContainer_q').length){
    audioPath = $('#playerContainer_q').data('src');
    console.log(audioPath);
    var cap = new CircleAudioPlayer({
      audio: audioPath,
      size: 120,
      borderWidth: 8,

    });
    cap.appendTo(playerContainer_q);
  }


    $(document).on('click','.retry',function(){
        $('#ajaxtest')[0].reset();
        $('.td_option').removeClass('td_answered');
        $('.result_container').hide();
        $('.test_container').show();
        $('html, body').animate({
                        scrollTop: (($('.testbox').offset().top - 100))
                    },500);


    });

    $(".duo").keyup(function () {
        if (this.value.length == this.maxLength) {
          var $next = $(this).next('.duo');
          var qid = '.q'+(parseInt($(this).data('id'))+1);
          var $next_parent = $(qid).children('.duo').first();
          console.log($next_parent);
          if ($next.length)
              $(this).next('.duo').focus();
          else if($next_parent.length)
              $next_parent.focus();
          else
              $(this).blur();
        }
    });

    $("#ajaxtest").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                  $('.test_container').hide();
                  $('html, body').animate({
                        scrollTop: (($('.testbox').offset().top - 100))
                    },500);
                  $('.result_container').show();
                   $('.result').html("<div class='p-4'><p>Your score is</p><h1>"+data+"</h1><button class='btn btn-primary retry'>Retry</button></div>");
                   console.log('ajaxsubmit');
               }
             });


    });

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
          console.log(123);
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

@elseif(isset($gre))
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


@elseif(isset($pte))
<script type="application/javascript" src="{{asset('js/jquery-ui-min.js')}}"></script>  
<script type="application/javascript">
$(function() {

  if($(".duo").length)
  $(".duo").keyup(function () {
        if (this.value.length == this.maxLength) {
          var $next = $(this).next('.duo');
          var qid = '.q'+(parseInt($(this).data('id'))+1);
          var $next_parent = $(qid).children('.duo').first();
          console.log($next_parent);
          if ($next.length)
              $(this).next('.duo').focus();
          else if($next_parent.length)
              $next_parent.focus();
          else
              $(this).blur();
        }
    });

var isPlaying = false;

$(document).on('click','.audioed',function(){
      $id = $(this).data('id');
     var myAudio = document.getElementById("audio_"+$id);
      togglePlay(myAudio)
    
      myAudio.onplaying = function() {
        isPlaying = true;
      };
      myAudio.onpause = function() {
        isPlaying = false;
      };

    });

function togglePlay(myAudio) {
        console.log(isPlaying);
        if (isPlaying) {
          myAudio.pause()
        } else {
          myAudio.play();
        }
      };


  // select words
  $(document).on('click','.select_word',function(){
    $subid = $(this).data('subid');
    if($(this).hasClass('select_word_selected')){
      $('.'+$subid).prop("checked", false);

      $(this).removeClass('select_word_selected');
    }
    else{
      $('.'+$subid).prop("checked", true);
      $(this).addClass('select_word_selected');
    }
  });

  // select audio
  $(document).on('click','.checkitem',function(){
    $class = $(this).data('class');
    if($(this).hasClass('checkitem_selected')){
      $('.'+$class).prop("checked", false);
      $(this).removeClass('checkitem_selected');
      $('.a_'+$class).removeClass('audioitem_selected');
    }
    else{
      $('.'+$class).prop("checked", true);
      $(this).addClass('checkitem_selected');
      $('.a_'+$class).addClass('audioitem_selected');
    }
  });
  
  

  if($( "#sortable-1a" ).length){
    $( "#sortable-1a, #sortable-1b" ).sortable({
      connectWith: "#sortable-1a, #sortable-1b",
      update: function(event, ui) {
      var d ='';
        $('#sortable-1b li').each(function(i)
        {
           d =  d +$(this).data('val')+','; // This is your rel value
        });
        $('.reorder-1b').val(d);
      }
    });
  }
  if($( "#sortable-2a" ).length){
    $( "#sortable-2a, #sortable-2b" ).sortable({
      connectWith: "#sortable-2a, #sortable-2b",
      update: function(event, ui) {
      var d ='';
        $('#sortable-2b li').each(function(i)
        {
           d =  d +$(this).data('val')+','; // This is your rel value
        });
        $('.reorder-2b').val(d);
      }
    });
  }
  if($( "#sortable-3a" ).length){
    $( "#sortable-3a, #sortable-3b" ).sortable({
      connectWith: "#sortable-3a, #sortable-3b",
      update: function(event, ui) {
      var d ='';
        $('#sortable-3b li').each(function(i)
        {
           d =  d +$(this).data('val')+','; // This is your rel value
        });
        $('.reorder-3b').val(d);
      }
    });
  }
  if($( "#sortable-4a" ).length){
    $( "#sortable-4a, #sortable-4b" ).sortable({
      connectWith: "#sortable-4a, #sortable-4b",
      update: function(event, ui) {
      var d ='';
        $('#sortable-4b li').each(function(i)
        {
           d =  d +$(this).data('val')+','; // This is your rel value
        });
        $('.reorder-4b').val(d);
      }
    });
  }
});

/* drag and drop */
$( function() {
    $( ".draggable" ).draggable({ revert: "valid" });
    $( ".droppable" ).droppable({
      drop: function( event, ui ) {
        $( this ).addClass("bg-light");
        $(this).attr('value',$(ui.draggable).text());        
      }
    });

    $( ".droppable" ).dblclick(function() {
      $( this ).removeClass("bg-light");
      $( this ).attr('value','');
    });
  } );

</script>
<script type="application/javascript">

  startProgress();

  function startProgress($id=1){
    if($('.progress-bar').length){
      $scount = $('.greblock_'+$id).data('scount');
      $width = 100 / parseInt($scount);
      $('.progress-bar').css('width',$width+"%");
    }
  }

  function updateProgress($id){
    if($('.progress-bar').length){
      $scount = $('.greblock_'+$id).data('scount');
      $sno = $('.greblock_'+$id).data('section');
      $width = 100 / parseInt($scount) * $sno;
      $('.progress-bar').css('width',$width+"%");
    }
  }
 
  $(".td_option").click(function() {
        $id = $(this).data('id');
        $qno = $id;
        $option = $(this).data('option');
        $group = $(this).data('group');
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

    /* Review Button */
    $('.gre_prev').on('click',function(e){

        $qno = $(this).data('qno');
        console.log($qno);
        $section = $('.greblock_'+$qno).data('section');
        $sno = $('.greblock_'+$qno).data('sno');

        updateProgress($section);

        if($qno){
            $('.gre_qno').html($sno);
            $('.gre_section').html($section);

            $('.qblock').hide();
            $('.greblock_'+$qno).show();

            $qno = $qno - 1;
            //update the navbar
            if($('.greblock_'+$qno).length){
              $('.gre_next').data('qno',($qno+2));
              $(this).data('qno',$qno);
              if($('.gre_next').data('qno'))
                $('.gre_next').removeClass('disabled');
            }
            else{
              $('.gre_next').data('qno',($qno+2));
              $(this).data('qno',0);
              $(this).addClass('disabled');
            }

            
        
        }else{
            $('.gre_prev').addClass('disabled');
        }
    });


    $('.gre_next').on('click',function(e){
      $qno = $(this).data('qno');
      $section = $('.greblock_'+$qno).data('section');
      $sno = $('.greblock_'+$qno).data('sno');
      
      //end duolingo test
      if(!$sno){
          if($(this).data('duo')){
            $('#test_submit').modal();
            return false;
          }
        } 

      updateProgress($section);
      if($qno){
        $('.gre_section').html($section);

        $('.qblock').hide();
        $('.greblock_'+$qno).show();
        $qno = $qno +1;

        

        

        //update the navbar
        if($('.greblock_'+$qno).length){
            $('.gre_prev').data('qno',($qno-2));
            $('.gre_next').data('qno',$qno);
            if($qno-2!=0)
                $('.gre_prev').removeClass('disabled');
        }
        else{
          $('.gre_prev').data('qno',($qno-2));
          $('.gre_next').data('qno',0);
          $(this).addClass('disabled');

          if($('.next_text').length){
            $('.next_text').html('Submit');
            $('.next-btn').addClass('btn-submit-duo');
          }
          
        }   

           
      }


    });

</script>
@endif

@if(isset($timer))
@if($time)
<script type="application/javascript">
// Set the datetimepicker we're counting down to
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
  if($('#timer').is(':visible'))
  document.getElementById("timer").innerHTML =  t;

  if($('#timer2').is(':visible'))
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


  
/* prevent refresh */






</script>
@endif
@endif


@if(isset($secs))
@foreach($secs as $sec => $section)
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script type="text/javascript">
  var options_{{$section->section_id}} = {
  type: 'horizontalBar',
  data: {
    labels: ["{{$section->labels[0]}}" @if(isset($section->two)),"{{$section->labels[1]}}" @endif @if(isset($section->three)),"{{$section->labels[2]}}" @endif @if(isset($section->four)),"{{$section->labels[3]}}" @endif @if(isset($section->five)),"{{$section->labels[4]}}" @endif],
    datasets: [{
      label:'',
      data: [{{$section->one}} @if(isset($section->two)), {{$section->two}}@endif @if(isset($section->three)), {{$section->three}}@endif @if(isset($section->four)), {{$section->four}} @endif  @if(isset($section->five)), {{$section->five}}@endif],
      backgroundColor: [
                '{{$section->one_color}}',
                @if(isset($section->two))'{{$section->two_color}}', @endif
                @if(isset($section->three))'{{$section->three_color}}', @endif
                @if(isset($section->four))'{{$section->four_color}}', @endif
                @if(isset($section->five))'{{$section->five_color}}' @endif
            ]
    }]
  },
  options: {
    legend: {
        display: false
    },
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
}

var ctx_{{$section->section_id}} = document.getElementById({{$section->section_id}}+'Container').getContext('2d');
new Chart(ctx_{{$section->section_id}},options_{{$section->section_id}});

</script>
@endforeach
@endif


@if(isset($datetimepicker))

<script src="{{ asset('js/datetimepicker/build/jquery.datetimepicker.full.min.js') }}"></script>
<script>/*
window.onerror = function(errorMsg) {
  $('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2019-08-15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
  $("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
  $.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({timepicker:false,
 format:'Y-m-d H:i:s'});
$('#datetimepicker_2').datetimepicker({timepicker:false,
 format:'Y-m-d H:i:s'});
/*
$('#datetimepicker').datetimepicker({value: {{date("Y")}}+'/'+{{date("m")}}+'/'+{{date("d")}}+' 16:03', step:10});  */
 


</script>
@endif


@if(isset($joinnow))
<script>
  $(document).scroll(function() {
  var y = $(this).scrollTop();
  if (y > 90) {
    $('.joinnow').fadeIn();
  } else {
    $('.joinnow').fadeOut();
  }
});
</script>
@endif

@if(isset($testedit))
<script>
  $(document).ready(function(){
      
    $('.btn-section-save').on('click',function(){
      var url = $(this).data('url');
      var text = $(this).text();
      var id = $(this).data('id');
      var _token = $(this).data('token');
      var name = $('.sec_name_'+id).text();
      var instructions = $('.sec_instructions_'+id).text();

      $.ajax({
               type: "GET",
               url: url,
               data: {"name":name,"instructions":instructions,"_token":_token}, 
               success: function(data)
               {
                  console.log('success');
                  
               }
             });
    });

    $('.btn-fillup-save').on('click',function(){
      var url = $(this).data('url');
      var text = $(this).text();
      var id = $(this).data('id');
      var _token = $(this).data('token');
      var label = $('.f_label_'+id).text();
      var prefix = $('.f_prefix_'+id).text();
      var suffix = $('.f_suffix_'+id).text();
      var answer = $('.f_answer_'+id).val();

      if(!$('.f_answer_'+id).length){
        alert('This question type is not editable...talk to Teja he will enable it :)');
        return;
      }
      if(!answer){
        alert('Answer not given');
        return;
      }

      $.ajax({
               type: "GET",
               url: url,
               data: {"label":label,"prefix":prefix,"answer":answer,"suffix":suffix,"_token":_token}, 
               success: function(data)
               {
                  console.log('success');
               }
             });
    });

  });

</script>
@endif

@if(isset($front))
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
<script type="text/javascript">

var options = {
  strings: ["<a href='../studyabroad/'>the best advice</a>",
               "<a href='../courses/'>ready to take-off!!</a>", 
              "<a href='../reviews/'>the best training</a>",
               "<a href='../downloads/'>free stuff</a>"],
          typeSpeed: 100, // typing speed
            backDelay: 2500, // pause before backspacing
            loop: true, // loop on or off (true or false)
            loopCount: false, 
};

if($('.element').length)
var typed = new Typed('.element', options);



</script>
@endif