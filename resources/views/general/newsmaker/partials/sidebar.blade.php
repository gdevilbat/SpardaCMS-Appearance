<aside id="sidebar" class="sidebar">
    <section class="sidebar-nav sidebar-top">
        <p class="h6">Masuk Portal Dengan</p>
		<div class="button-area">
		    <a href="javascript:;" class="btn btn-sosial-media btn-facebook">
		        <img src="{{module_asset_url('appearance:assets/icon/facebook.png')}}" alt="Facebook Icon">
		        Facebook
		    </a>
		    <a href="javascript:;" class="btn btn-sosial-media btn-google">
		        <img src="{{module_asset_url('appearance:assets/icon/google.png')}}" alt="Google Icon">
		        Google
		    </a>
		</div>
    </section>
    <ul class="list-group">
        <li class="list-group-item">
            Dark Mode
            <label class="switch">
                <input type="checkbox" class="default" onclick="myFunction()">
                <span class="slider-dark round"></span>
            </label>
        </li>
    </ul>
    <section class="sidebar-nav">
        <ul>
            <li>
                <img src="{{module_asset_url('appearance:assets/icon/home.png')}}" alt="Home Icon">
                <span>Beranda</span>
                <a href="javascript:;" class="url"></a>
            </li>
            <li>
                <img src="{{module_asset_url('appearance:assets/icon/trending.png')}}" alt="Trending Icon">
                <span>Trending</span>
                <a href="javascript:;" class="url"></a>
            </li>
            <li>
                <img src="{{module_asset_url('appearance:assets/icon/video.png')}}" alt="Video Icon">
                <span>Video</span>
                <a href="javascript:;" class="url"></a>
            </li>
            <li>
                <img src="{{module_asset_url('appearance:assets/icon/album.png')}}" alt="Photo Album Icon">
                <span>Photo Album</span>
                <a href="javascript:;" class="url"></a>
            </li>
        </ul>
    </section>
    <section class="sidebar-nav">
        @foreach ($navbars as $navbar)
            @if(isset($navbar->children))
                <h6>
                    <a class="btn-collapse" data-toggle="collapse" href="#collapseExample-{{$loop->depth}}-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample" title="{{$navbar->title}}">
                        {{$navbar->text}}
                        <img src="{{module_asset_url('appearance:assets/icon/arrow_down.png')}}" alt="Arrow Down">
                    </a>
                </h6>
                <ul class="collapse" id="collapseExample-{{$loop->depth}}-{{$loop->iteration}}">
                    @include('appearance::general.classic.partials.navbar_child', ['navbars' => $navbar->children])
                </ul>
            @else
                <ul>
                    <li>
                        <span>{{$navbar->text}}</span>
                        <a href="{{isset($navbar->slug) ? url($navbar->slug) : 'javascript:void(0)'}}" target="{{$navbar->target}}" title="{{$navbar->title}}" class="url"></a>
                    </li>
                </ul>
            @endif
        @endforeach
    </section>
    <section class="sidebar-nav sidebar-bottom">
        <h6>
            <a class="btn-collapse" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Tentang Kami
                <img src="{{module_asset_url('appearance:assets/icon/arrow_down.png')}}" alt="Arrow Down">
            </a>
        </h6>
        <ul class="collapse" id="collapseExample">
            <li>
                <span>Hidup di Kantor Kami</span>
                <a href="javascript:;" class="url"></a>
            </li>
            <li>
                <span>Ketentuan & Kebijakan Privacy</span>
                <a href="javascript:;" class="url"></a>
            </li>
            <li>
                <span>Bantuan</span>
                <a href="javascript:;" class="url"></a>
            </li>
            <li>
                <span>Panduan Pojok Aspirasi</span>
                <a href="javascript:;" class="url"></a>
            </li>
            <li>
                <span>Pamer (Iklan)</span>
                <a href="javascript:;" class="url"></a>
            </li>
        </ul>
    </section>
    <section class="sidebar-nav">
        <h6>Sosial Media</h6>
        <ul>
            <li>
                <img src="{{module_asset_url('appearance:assets/icon/fb.png')}}" alt="Facebook Icon">
                <span>Facebook</span>
                <a href="javascript:;" class="url"></a>
            </li>
            <li>
                <img src="{{module_asset_url('appearance:assets/icon/instagram.png')}}" alt="Instagram Icon">
                <span>Instagram</span>
                <a href="javascript:;" class="url"></a>
            </li>
            <li>
                <img src="{{module_asset_url('appearance:assets/icon/twitter.png')}}" alt="Twitter Icon">
                <span>Twitter</span>
                <a href="javascript:;" class="url"></a>
            </li>
            <li>
                <img src="{{module_asset_url('appearance:assets/icon/youtube.png')}}" alt="Youtube Icon">
                <span>Youtube</span>
                <a href="javascript:;" class="url"></a>
            </li>
            <li>
                <img src="{{module_asset_url('appearance:assets/icon/linkedin.png')}}" alt="Linked In Icon">
                <span>Linked In</span>
                <a href="javascript:;" class="url"></a>
            </li>
        </ul>
    </section>
    <section class="sidebar-nav">
        @include('appearance::general/newsmaker/partials/footer')
    </section>
</aside>