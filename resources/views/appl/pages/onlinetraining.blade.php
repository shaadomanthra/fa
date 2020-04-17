
@extends('layouts.front')
@section('title', 'IELTS')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;900&display=swap" rel="stylesheet">
<style>
  .Montserrat { font-family: 'Montserrat', sans-serif; line-height: 1.8; }
.orange{
  color:#ff8155;
  font-family: 'Montserrat', sans-serif;
  line-height: 1.6;
}
.ash{
  color:#999ea5;
  font-family: 'Montserrat', sans-serif;
  line-height: 1.6
}
.list ul{ list-style: none;padding: 0px; margin:0px; }
.fw900{ font-weight: 900 }
.fw500{ font-weight: 500 }
.fw400{ font-weight: 400 }
.fw100{ font-weight: 100 }
.lh15{line-height: 1.2}
.mleft{ margin-left: -150px }
.mtop{ margin-top: 100px }
.w700{ width:700px; }
.f50{ font-size:40px; }
.f60{ font-size:60px; }
.f18{font-size:18px;}

.round{ border:1px solid #fff; border-radius:50px;width:80px; height:80px;text-align: center;padding:10px;padding-left: 10px;padding-top:18px;box-shadow: 1px 5px 10px 1px #e2f4ff;   }
.bg-blight{background: #f6f9ff;}
.black{color:#43464c}

@media only screen and (max-width: 1200px) {
  .mleft{ margin-left: -250px;  }
.mtop{ margin-top: 100px }
  }

@media only screen and (max-width: 990px) {
  .mleft{ margin-left: -350px;  }
.mtop{ margin-top: 100px }
  }
@media only screen and (max-width: 768px) {
  .mleft{ margin-left: 0px; width:100%;padding:30px; }
.mtop{ margin-top: 50px }
  }
</style>
<div class="container">
<div class="row mt-4 mb-4">
  
  <div class="col-12 col-md-6">
    <img src="{{ asset('images/pageimages/ppc_img.png')}}" class="mleft mtop w700  " />
  </div>
  <div class="col-12 col-md-6">
    <div class="mt-5 mt-md-5 ml-3">
     
    <h5 class="orange fw900">Customise Your Training</h5>
                                <h1 class='Montserrat fw900 f50 lh15 black'>Experience the best IELTS training.</h1>
                                <h5 class="ash">1 on 1 expert tutorials, Writing Assessments, Speaking Feedback!</h5>

    <div class="list mt-4 Montserrat">
                                <ul>
                                    <li>
                                      <div class="row">
                                        <div class="col-4 col-md-2">
                                          <div class="round orange mb-4 mb-md-0">
                                            <i class="fa fa-magic fa-3x"></i>
                                          </div>
                                        </div>
                                        <div class="col-12 col-md-10">
                                          <div class="ml-3 mb-4">
                                            <h5 class="fw900 black">1-on-1 Expert Tutorials</h5>
                                            <p>Sit in-person with the trainer and get feedback and expert guidance on <i><u>your</u></i> performance</p>
                                          </div>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="row">
                                        <div class="col-4 col-md-2">
                                          <div class="round orange mb-4 mb-md-0">
                                            <i class="fa fa-file-text-o fa-3x"></i>
                                          </div>
                                        </div>
                                        <div class="col-12 col-md-10">
                                          <div class="ml-3 mb-4">
                                            <h5 class="fw900 black">Writing Assessments</h5>
                                            <p>Get your writing tasks assessed with indepth analysis and comprehensive feedback and assistance.</p>
                                          </div>
                                        </div>
                                      </div>
                                       
                                    </li>
                                    <li>
                                      <div class="row">
                                        <div class="col-4 col-md-2">
                                          <div class="round orange mb-4 mb-md-0">
                                            <i class="fa fa-shield fa-3x"></i>
                                          </div>
                                        </div>
                                        <div class="col-12 col-md-10">
                                          <div class="ml-3 mb-4">
                                            <h5 class="fw900 black">Unlimited Sessions</h5>
                                            <p>Choose from a range of online and classroom sessions and attend at a time that suits you.</p>
                                          </div>
                                        </div>
                                      </div>

                                    </li>
                                </ul>
                            </div>

    <button type="button" class="btn btn-success w-100 p-3 mt-4" style="max-width:400px"><div class="mb-0 bold">Take a FREE Test!</div></button>
    <div class="mt-3"></div>
    </div>


  </div>
</div>
</div>

<div class="bg-blight">
<div class="container">
 <section class="ppc-analytics pt-5 pb-5 Montserrat ">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="ppc-img">
                                <img src="{{ asset('images/pageimages/ppc_img02.png') }}" class='w-100 mb-4 mb-md-0'>
                            </div>
                        </div>
                        <div class="col-lg-6 s-about-p pl-45">
                          <div class="ml-md-4">
                            <div class="inner-title mb-25">
                                <h5 class="orange fw900">KT Please Read Through | Additional Text</h5>
                                <h1 class='Montserrat fw900 f50 lh15 black'>We can have text, counters and buttons and what not in this area.</h1>
                            </div>
                            <div class="about-content">
                                <h5 class="orange">We can have a band of greyd out buttons on top of this area? Like logos which can be hash links. We can remove the image here and have something else or also have buttons with the image.</h5>
                                <h5 class="ash mb-5">In place of the counters, we can have text or buttons, or something else. Or we can have links to writing material or whatever. Also, can we have hash links in the page? Or we can allow them to scroll through.. I want visitors to scroll down to look at our material too. We could do it with buttons</h5>
                                <div class="row">
                                  <div class="col-12 col-md-4">
                                    <div class="single-counter text-center">
                                                <h2><span class="counter c1">25</span>
                                                  <span>K</span><large class='orange f18' >+</large></h2>
                                                <p>Students Trained</p>
                                            </div>
                                  </div>
                                  <div class="col-12 col-md-4">
                                   <div class="single-counter text-center">
                                                <h2><span class="counter c2">7.5</span> <small class='orange f18' >Band</small></h2>
                                                <p>Average Score</p>
                                            </div>
                                  </div>
                                  <div class="col-12 col-md-4">
                                    <div class="single-counter text-center">
                                                <h2><span class="counter c3">6785</span><small class='orange f18'>+</small></h2>
                                                <p>Practice Tests Taken</p>
                                            </div>
                                  </div>

                                    
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </section>
</div>
</div>

<div class="bg-white">
<div class="container">
<div class="row ">
                        <div class="col-lg-6">
                          <div class="mt-5">
                            <h5 class="orange fw900">FAQ</h5>
                                <h1 class='Montserrat fw900 f50 lh15 black mb-5'>Always support our customers</h1>
                          <div class="" id="accordionExample">
  <div class="p-1 mb-3 bg-blight rounded">
    <div class="p-3" id="">
      <h2 class="mb-0 ">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <span class='black fw900'>Q.</span> <span class="orange fw900">Collapsible Group Item #1</span>
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="p-4 pt-0">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="p-1 mb-3 bg-blight rounded">
    <div class="p-3" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <span class='black fw900'>Q.</span> <span class="orange fw900">Collapsible Group Item #2</span>
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="p-4">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="p-1 mb-3 bg-blight rounded">
    <div class="p-3" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <span class='black fw900'>Q.</span> <span class="orange fw900">Collapsible Group Item #3</span>
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="p-4">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
                        </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="ppc-img p-5">
                                <img src="{{ asset('images/pageimages/faq.png') }}" class='w-100'>
                            </div>
                        </div>
                        </div>
</div>
</div>
@endsection           