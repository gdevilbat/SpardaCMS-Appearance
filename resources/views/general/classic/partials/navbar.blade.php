<nav class="navbar navbar-spy navbar-expand-lg navbar-fixed-top mainmenu-area">
  <div class="container">
    <div class="w-100">
        <div class="col-12">
            <div id="search-box" class="collapse">
                <form action="#">
                    <input type="search" class="form-control mb-1" placeholder="What do you want to know?">
                </form>
            </div>
        </div>
        <div class="col-12">
          <div class="d-flex float-lg-left">
            <img class="img-logo" src="{{empty($settings->where('name','global')->flatten()->first()->value['logo']) ? module_asset_url('core:assets/images/Spartan.png') : url($settings->where('name','global')->flatten()->first()->value['logo'])}}" alt="logo">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars"></i>
            </button>
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
                <li><a class="nav-link" href="#search-box" data-toggle="collapse"><i class="icofont icofont-search-alt-2"></i></a></li>
            </ul>
          </div>
      </div>
    </div>
  </div>
</nav>