<header>
  <nav class="navbar navbar-expand-lg mainmenu-area position-relative sticky"  data-toggle="sticky-onscroll">
    <div class="container">
      <div class="col-12 d-flex flex-wrap flex-lg-nowrap">
        <div class="d-flex float-lg-left order-1">
          <a href="{{url('/')}}" title="homepage">
            <img class="img-logo" src="{{empty($settings->where('name','global')->flatten()->first()->value['logo']) ? module_asset_url('core:assets/images/Spartan.png') : generate_storage_url($settings->where('name','global')->flatten()->first()->value['logo'])}}" alt="logo">
          </a>
        </div>
        <div class="collapse navbar-collapse px-3 px-lg-0 order-5 order-lg-2" id="navbarSupportedContent">
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
          </ul>
        </div>
        <div class="col d-flex order-3">
          <div class="container-action d-flex search-navbar col pl-0">
              <form action="{{action('\Gdevilbat\SpardaCMS\Modules\Blog\Http\Controllers\BlogController@search')}}" class="position-relative  align-self-center d-flex w-100">
                  <input type="text" class="search-bar" placeholder="Search" name="query" value="{{Request::input('query')}}" required>
                  <i class="fas fa-search icon-search align-self-center" style="cursor: pointer;" onclick="return formValidation(event)"></i>
              </form>
          </div>
          <div class="d-flex align-items-center ml-auto">
            <button class="navbar-toggler text-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header><!-- /header -->