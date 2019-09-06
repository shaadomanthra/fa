 <html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
                font-family: Arial, Helvetica, sans-serif;font-size:18px;
            }


            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;

                /** Extra personal styles **/
                background-color: #f8f8f8;
                color: #1f70ab;
                text-align: left;
                padding-left:30px;
                padding-right: 30px;
                font-family:  sans-serif;font-size:18px;
                line-height: 1.5cm;
            }

            hr{ 
              height: 1px;
              color: red;
              background-color: #eee;
              border: 1px solid silver;
            }
            .response{
            	font-family: Arial, Helvetica, sans-serif;
            	font-size:18px;
            	line-height: 70px;
            }

            .head{padding:20px;background:#f8f8f8;margin-bottom:30px; font-family: Arial, Helvetica, sans-serif;font-size:18px;line-height: 25px;border:1px solid #eee;}
            .bord{ border: 1px solid #eee; padding:20px; }

        </style>
    </head>
    <body>
        <main>
            <div class="head">
            <div style="padding-bottom: 10px"><span class="" >Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>{{$obj->user->name }}</div>
            <div><span class="" >Test date: &nbsp;&nbsp;&nbsp;&nbsp;</span>{{ date("F j, Y, g:i a",strtotime($obj->created_at))}}</div>
            </div>
            @if(strlen(strip_tags($obj->test->description))>0)
			<div class=""><b>Question</b></div>
			{!!  preg_replace("/<img[^>]+\>/i", "", $obj->test->description);  !!}
			<hr>
			<div class=""><b>Response</b></div>
			@endif
           <div class="response">{!! $obj->response !!}</div>
        </main>

    </body>
</html>
