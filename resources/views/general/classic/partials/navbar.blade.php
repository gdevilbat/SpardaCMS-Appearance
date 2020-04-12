<header>
  <nav class="navbar navbar-expand-lg mainmenu-area position-relative sticky"  data-toggle="sticky-onscroll">
    <div class="container">
      <div class="w-100">
          <div class="col-12">
              <div id="search-box" class="collapse">
                  <form action="{{action('\Gdevilbat\SpardaCMS\Modules\Blog\Http\Controllers\BlogController@search')}}">
                      <input type="search" class="form-control mb-1" placeholder="What do you want to know?"  name="query" value="{{Request::input('query')}}">
                  </form>
              </div>
          </div>
          <div class="col-12">
            <div class="d-flex float-lg-left">
              <a href="{{url('/')}}" title="homepage">
                <img class="img-logo" src="{{empty($settings->where('name','global')->flatten()->first()->value['logo']) ? module_asset_url('core:assets/images/Spartan.png') : generate_storage_url($settings->where('name','global')->flatten()->first()->value['logo'])}}" alt="logo">
              </a>
              <div class="d-flex align-items-center ml-auto">
  	            <a class="nav-link float-left text-white d-lg-none" href="#search-box" data-toggle="collapse"><i class="fa fa-search"></i></a>
  	            <button class="navbar-toggler text-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  	              <i class="fas fa-bars"></i>
  	            </button>
              </div>
            </div>
            <div class="collapse navbar-collapse px-3 px-lg-0" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                @foreach ($navbars as $navbar)
                    @if(isset($navbar->children))
                      <li class="dropdown">
                        <a href="{{isset($navbar->slug) ? url($navbar->slug) : 'javascript:void(0)'}}" target="{{$navbar->target}}" title="{{$navbar->title}}" class="dropdown-toggle nav-link" aria-haspopup="true" aria-expanded="false">
                          {{$navbar->text}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          @include('appearance::general.classic.partials.navbar_child', ['navbars' => $navbar->children])
                        </ul>
                      </li>
                    @else
                      <li>
                        <a class="nav-link" href="{{isset($navbar->slug) ? url($navbar->slug) : 'javascript:void(0)'}}" target="{{$navbar->target}}" title="{{$navbar->title}}">{{$navbar->text}}</a>
                      </li>
                    @endif
                  @endforeach
                  <li class="d-none d-lg-block"><a class="nav-link" href="#search-box" data-toggle="collapse"><i class="fa fa-search"></i></a></li>
              </ul>
            </div>
        </div>
      </div>
    </div>
  </nav>
</header><!-- /header -->