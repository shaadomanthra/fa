
@if(isset($editor))
<script src="{{asset('js/jquery.js')}}"></script>  
<script src="{{asset('js/script.js')}}"></script>  
<script src="{{asset('js/summernote/summernote-bs4.js')}}"></script>    
<script src="{{asset('js/jquery.form.js')}}"></script> 
<script src="{{asset('js/global.js')}}"></script>  


<script>
    $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'Hello ! Write something...',
                tabsize: 2,
                height: 200,                // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: true,
              });
          });

</script>
@elseif(isset($reading))
<script src="{{asset('js/jquery.js')}}"></script>  
<script src="{{asset('js/script.js')}}"></script>  
<script>
    $( document ).ready(function() {
    var height = $( window ).height();
    var width = $( window ).width();
    var nav = $('.navbar').height();
    var bottom = $('.bottom-qno').height();
    var h = height-nav-70;
    console.log(h);
    if(width<768)
    $('.panel').css('height',h/2);
    else
    $('.panel').css('height',h);

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
<script src="{{asset('js/player.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>  
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('js/global.js')}}"></script>  

<script>
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


/*
@if(isset($test))
@foreach($test->sections as $s=>$section)
 on('.load_s{{$s}}', 'click', () => { 
    const load = document.querySelector('.load_s{{$s}}');
    if(player.source==load.dataset.file){
        player.togglePlay();
}else{
    console.log(player.source);
    $('.trackname').html('{{$section->name}}');
    player.source = {
    type: 'audio',
    sources: [
        {
            src: load.dataset.file,
            type: 'audio/mp3',
        },
    ],
    };
    player.togglePlay();
}
});
@foreach($section->extracts as $k =>$extract)
 on('.load_{{$s.$k}}', 'click', () => { 
    const load = document.querySelector('.load_{{$s.$k}}');
    if(player.source==load.dataset.file){
        player.togglePlay();
}else{
    console.log(player.source);
    $('.trackname').html('{{$extract->name}}');
    player.source = {
    type: 'audio',
    sources: [
        {
            src: load.dataset.file,
            type: 'audio/mp3',
        },
    ],
    };
    player.togglePlay();
}
    
    

  });
 @endforeach
 @endforeach
 @endif


  on('.play2', 'click', () => { 
    alert($(this).data('seek'));
    player.stop();
    player.forward(10);
    player.play();
  });

  // Pause
  on('.pause', 'click', () => { 
    player.pause();
  });
*/
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
<script src="{{asset('js/script.js')}}"></script>  
@endif

@if(isset($timer))
<script>
// Set the date we're counting down to
@if(!isset($time))
var countDownDate = addMinutes(new Date(),{{ count($questions) }});
@else
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
</script>
@endif
