
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
@elseif(isset($player))
<script src="{{asset('js/player.js')}}"></script>
<script id="rendered-js">

</script>
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

  on('.play', 'click', () => { 
    player.play();
  });

  // Pause
  on('.pause', 'click', () => { 
    player.pause();
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