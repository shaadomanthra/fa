 <a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} ">
                  {!! $obj->question !!}
                  </a>
                  
                  <div>
                    @if(strpos($obj->answer, 'A') !== FALSE)
                     <span class="text-success">(A)</span> 
                    @else
                    <span >(A)</span>
                    @endif
                    {!! $obj->a !!}
                  </div>
                  <div>
                    @if(strpos($obj->answer, 'B') !== FALSE)
                     <span class="text-success">(B)</span> 
                    @else
                    <span >(B)</span>
                    @endif
                    {!! $obj->b !!}
                  </div>
                  <div>
                    @if(strpos($obj->answer, 'C') !== FALSE)
                     <span class="text-success">(C)</span> 
                    @else
                    <span >(C)</span>
                    @endif
                    {!! $obj->c !!}
                  </div>

                  @if($obj->d)
                  <div>
                    @if(strpos($obj->answer, 'D') !== FALSE)
                     <span class="text-success">(D)</span> 
                    @else
                    <span >(D)</span>
                    @endif
                    {!! $obj->d !!}
                  </div>
                  @endif

                  @if($obj->e)
                  <div>
                    @if(strpos($obj->answer, 'E') !== FALSE)
                     <span class="text-success">(E)</span> 
                    @else
                    <span >(E)</span>
                    @endif
                    {!! $obj->e !!}
                  </div>
                  @endif

                  @if($obj->f)
                  <div>
                    @if(strpos($obj->answer, 'F') !== FALSE)
                     <span class="text-success">(F)</span> 
                    @else
                    <span >(F)</span>
                    @endif
                    {!! $obj->f !!}
                  </div>
                  @endif

                  @if($obj->g)
                  <div>
                    @if(strpos($obj->answer, 'G') !== FALSE)
                     <span class="text-success">(G)</span> 
                    @else
                    <span >(G)</span>
                    @endif
                    {!! $obj->g !!}
                  </div>
                  @endif

                  @if($obj->h)
                  <div>
                    @if(strpos($obj->answer, 'H') !== FALSE)
                     <span class="text-success">(H)</span> 
                    @else
                    <span >(H)</span>
                    @endif
                    {!! $obj->h !!}
                  </div>
                  @endif

                  @if($obj->i)
                  <div>
                    @if(strpos($obj->answer, 'I') !== FALSE)
                     <span class="text-success">(I)</span> 
                    @else
                    <span >(I)</span>
                    @endif
                    {!! $obj->i !!}
                  </div>
                  @endif