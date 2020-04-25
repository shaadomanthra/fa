<picture >
  <source srcset="{{ asset('/storage/test/'.$test->slug.'_300.webp') }} 320w,
   {{ asset('/storage/test/'.$test->slug.'_600.webp') }}  480w,
   {{ asset('/storage/test/'.$test->slug.'_900.webp') }}  800w,
   {{ asset('/storage/test/'.$test->slug.'_1200.webp') }}  1100w" type="image/webp" sizes="(max-width: 320px) 280px,
   (max-width: 480px) 440px,
   (max-width: 720px) 800px
   1200px" alt="{{  $test->name }}" class="image-thumbnail w-100 d-none d-md-block">
   <source srcset="{{ asset('/storage/test/'.$test->slug.'_300.jpg') }} 320w,
     {{ asset('/storage/test/'.$test->slug.'_600.jpg') }}  480w,
     {{ asset('/storage/test/'.$test->slug.'_900.jpg') }}  800w,
     {{ asset('/storage/test/'.$test->slug.'_1200.jpg') }}  1100w," type="image/jpeg" sizes="(max-width: 320px) 280px,
     (max-width: 480px) 440px,
     (max-width: 720px) 800px
     1200px" alt="{{  $test->name }}" class="image-thumbnail w-100 d-none d-md-block"> 
     <img srcset="{{ asset('/storage/test/'.$test->slug.'_300.jpg') }} 320w,
     {{ asset('/storage/test/'.$test->slug.'_600.jpg') }}  480w,
     {{ asset('/storage/test/'.$test->slug.'_900.jpg') }}  800w,
     {{ asset('/storage/test/'.$test->slug.'_1200.jpg') }}  1100w,"
     sizes="(max-width: 320px) 280px,
     (max-width: 480px) 440px,
     (max-width: 720px) 800px
     1200px"
     src="{{ asset('/storage/test/'.$test->slug.'_600.jpg') }} " class="image-thumbnail w-100 d-none d-md-block" alt="{{  $test->name }}">
   </picture>