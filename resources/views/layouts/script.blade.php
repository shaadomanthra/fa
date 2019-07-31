
@if(isset($editor))
<script src="{{asset('js/jquery.js')}}"></script>  
<script src="{{asset('js/script.js')}}"></script>  
<script src="{{asset('js/summernote/summernote-bs4.js')}}"></script>    
<script src="{{asset('js/jquery.form.js')}}"></script>  
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
    var h = height-nav-80;
    console.log(width);
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

        });
       
    });

    
    $(".bottom-sno").click(function() {
            $id = "#"+$(this).data('id'); 
            $class = "."+$(this).data('id'); 
            
            if(Math.sign($('#0').offset().top)<0)
              $h = $('#0').offset().top*(-1) + $($id).offset().top + 10 ;
            else
              $h = $($id).offset().top -90;

            if(Math.sign($('.0').offset().top)<0)
              $h2 = $('.0').offset().top*(-1) + $($class).offset().top + 10 ;
            else
              $h2 = $($class).offset().top -90;

            $(".rightpanel").animate({
            scrollTop: $h 
        }, 1000);
            $(".leftpanel").animate({
            scrollTop: $h2 
        }, 50);
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


        $(".sno").click(function() {
            $id = "#"+$(this).data('id'); 
            $([document.documentElement, document.body]).animate({
            scrollTop: $($id).offset().top - 130
        }, 1000);
        });

        $(".qdata").hide();
        $(".qshow").click(function() {
            $(".qdata").slideToggle();
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
