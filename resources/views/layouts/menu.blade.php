@if($_SERVER['HTTP_HOST'] == 'project.test' || $_SERVER['HTTP_HOST'] == 'prep.firstacademy.in')
    @include('layouts.blocks.fa_menu')
@else
    @include('layouts.blocks.piofx_menu')
@endif