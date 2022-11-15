<header class="header">
    <div class="row">
        <div class="col-md-3 col-9 header-img">
            <a href="javascript:;" onclick="sidebar()">
                <img src="{{module_asset_url('appearance:assets/icon/menu.png')}}" alt="Menu Icon">
            </a>
            <a href="{{url('/')}}">
                <img src="{{empty($settings->where('name','global')->flatten()->first()->value['logo']) ? 'https://dummyimage.com/600x200/084494/fff' : url($settings->where('name','global')->flatten()->first()->value['logo'])}}" alt="Logo">
            </a>
        </div>
        <div class="col-md-6 header-search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Kata Pencarian..." aria-label="Kata Pencarian..." aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn " type="button">
                        <img src="{{module_asset_url('appearance:assets/icon/search.png')}}" alt="Search Icon">
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-3 text-right header-profil">
            <a href="javascript:;">
                <img src="{{module_asset_url('appearance:assets/icon/user.png')}}" alt="Profil Icon">
            </a>
        </div>
    </div>
</header>
