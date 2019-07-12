@extends('layouts.player')

@section('content')
<link rel='stylesheet' href='https://unpkg.com/plyr@3/dist/plyr.css'>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

<style>
.plyr {
    border:1px solid #b2eef3;
    
}
    .plyr--audio .plyr__controls{
        background: #cafbff;
        padding: 18px;
    }
    .sidebar{
        background:#284664;
        color:white;
    }
    .sno{
        background: #345575;
        font-weight:bold;
        width:100%;
        border-radius: 15px;  
        padding:5px;
    }
    .box a{
        color:white;
      
    }
    input.fill{
        border:0;
        border-bottom: 2px solid #0b5d6580;
        outline: none;
        margin-bottom: 10px;
    }
    .badge-warning{
        background: #b1e8ec;
    }
</style>

<div class="container ">
    <div class="row">
        <div class="col-12 col-md-8">
            <div class=" sticky-top">
                        <audio >
<source src="files/1.mp3" type="audio/mp3">
<source src="https://cdn.plyr.io/static/demo/Kishi_Bashi_-_It_All_Began_With_a_Burst.ogg" type="audio/ogg">
</audio>
            </div>

            
            <div class="bg-white scroll border mt-4 p-4">
                <div class="h4" id="item3">Destination: <span class="badge badge-warning h2">1</span> &nbsp;<input type="text" class="fill" ></div>
                <div class="h4" id="item4">Weather: <span class="badge badge-warning h2">2</span> &nbsp;<input type="text" class="fill" ></div>
                <div class="h4" id="item5">Arrival time: <span class="badge badge-warning h2">3</span> &nbsp;<input type="text" class="fill" ></div>
                <div class="h4" id="item6">Activities Planned: <span class="badge badge-warning h2">4</span> &nbsp;<input type="text" class="fill" ></div>
                <div class="h4">Eat: Catered lunch: <span class="badge badge-warning h2">5</span> &nbsp;<input type="text" class="fill" ></div>
                
                <div class="h4">Attend: <span class="badge badge-warning h2">6</span> &nbsp;<input type="text" class="fill" ></div>
                <br><br>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>


            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="sticky-top ">
                 <div class=" p-4  sidebar ">
                <h4 class="mb-4"><i class="fa fa-th"></i> Questions Pallete</h4>
                <div class="row no-gutters">
                @for($i=1;$i < 41; $i++ ) 
                <div class="col-2">
                    <div class="box pr-2 pb-2 text-center">
                        <a href="#item{{$i}}"><div class="sno">{{$i}}</div></a>
                    </div>
                    
                </div>
                @endfor
                </div>
                
                
            </div>
            </div>
           
        </div>
    </div>

</div>
<script src='https://unpkg.com/plyr@3'></script>
<script id="rendered-js">
const controls = [// Restart playback
    'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'pip', 'airplay', 'fullscreen',]
const player = new Plyr('audio', { controls });
// Expose player so it can be used from the console
window.player = player;

</script>

<div>Icons made by <a href="https://www.freepik.com/" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/"                 title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/"                 title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>

@endsection
