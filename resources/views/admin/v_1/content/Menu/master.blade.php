@extends('core::admin.'.$theme_cms->value.'.templates.parent')

@section('page_level_css')
    {{Html::style(module_asset_url('appearance:assets/plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css'))}}
@endsection

@section('title_dashboard', ' Menu')

@section('breadcrumb')
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
            <li class="m-nav__item m-nav__item--home">
                <a href="#" class="m-nav__link m-nav__link--icon">
                    <i class="m-nav__link-icon la la-home"></i>
                </a>
            </li>
            <li class="m-nav__separator">-</li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                    <span class="m-nav__link-text">Home</span>
                </a>
            </li>
            <li class="m-nav__separator">-</li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                    <span class="m-nav__link-text">Menu Builder</span>
                </a>
            </li>
        </ul>
@endsection

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="row">

            <div class="col-md-5">
                <div class="card border-success mb-3">
                    <div class="card-header bg-success text-white">Select Menu</div>
                        <div class="card-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="target">Target</label>
                                    <select name="taxonomy" class="form-control item-menu" id="taxonomy">
                                        @foreach($posts as $post)
                                            <option data-post-id="{{$post->id}}" value="{{$post->post_title}}">{{$post->post_title}}</option>
                                        @endforeach
                                        @foreach ($taxonomies as $taxonomy)
                                            <option data-term-id="{{$taxonomy->term_id}}" data-parent-id="{{$taxonomy->parent_id}}" value="{{$taxonomy->term->name}}">{{$taxonomy->term->name}}</option>
                                            @if(Route::current()->getController()->getChild($taxonomy)->taxonomyChildrens->count() > 0)
                                                @include('appearance::admin.'.$theme_cms->value.'.partials.taxonomy_child', ['taxonomy' => $taxonomy])
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    <div class="card-footer">
                        <button type="button" id="btnEditItem" class="btn btn-success"><i class="fas fa-pen"></i> Edit Item</button>
                    </div>
                </div>
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">Edit item</div>
                        <div class="card-body">
                            <form id="frmEdit" class="form-horizontal">
                                <div class="form-group">
                                    <label for="text">Text</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                                        <div class="input-group-append">
                                            <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"></button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="icon" class="item-menu">
                                </div>
                                <div class="form-group">
                                    <label for="target">Target</label>
                                    <select name="target" id="target" class="form-control item-menu">
                                        <option value="_self">Self</option>
                                        <option value="_blank">Blank</option>
                                        <option value="_top">Top</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Tooltip</label>
                                    <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                                </div>
                                <div class="form-group">
                                    <label for="term_id">Term ID</label>
                                    <input type="text" name="term_id" class="form-control item-menu" id="term_id" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Parent ID</label>
                                    <input type="text" name="parent_id" class="form-control item-menu" id="parent_id" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="post_id">Post ID</label>
                                    <input type="text" name="post_id" class="form-control item-menu" id="post_id" readonly>
                                </div>
                            </form>
                        </div>
                    <div class="card-footer">
                        <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                        <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-7">
                <div class="card mb-3">
                    <div class="card-header"><h5 class="float-left">Menu</h5>
                        <div class="float-right">
                            <button type="button" id="btnSave" class="btn btn-danger">
                                 Save Menu</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul id="myEditor" class="sortableLists list-group">
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
{{-- End of Row --}}

@endsection

@section('page_level_js')
    {{Html::script(module_asset_url('appearance:assets/plugins/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js'))}}
    {{Html::script(module_asset_url('appearance:assets/plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js'))}}
    {{Html::script(module_asset_url('appearance:assets/plugins/menu-builder/jquery-menu-editor.js?v='.filemtime(module_asset_path('appearance:assets/plugins/menu-builder/jquery-menu-editor.js'))))}}
@endsection

@section('page_script_js')
    <script type="text/javascript">

        $(document).ready(function () {
            // icon picker options
            var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
            // sortable list options
            var sortableListOptions = {
                placeholderCss: {'background-color': "#cccccc"}
            };

            /* =============== DEMO =============== */
            var sample = [{"href":"http://home.com","icon":"fas fa-home","text":"Home", "target": "_top", "title": "My Home"},{"icon":"fas fa-chart-bar","text":"Opcion2"},{"icon":"fas fa-bell","text":"Opcion3"},{"icon":"fas fa-crop","text":"Opcion4"},{"icon":"fas fa-flask","text":"Opcion5"},{"icon":"fas fa-map-marker","text":"Opcion6"},{"icon":"fas fa-search","text":"Opcion7","children":[{"icon":"fas fa-plug","text":"Opcion7-1","children":[{"icon":"fas fa-filter","text":"Opcion7-1-1"}]}]}];
            // menu items
            var arrayjson = {!!json_encode($navbars)!!};
            // icon picker options
            var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
            // sortable list options
            var sortableListOptions = {
                placeholderCss: {'background-color': "#cccccc"}
            };

            var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
            editor.setForm($('#frmEdit'));
            editor.setUpdateButton($('#btnUpdate'));
            $('#btnReload').on('click', function () {
                editor.setData(arrayjson);
            });

            $('#btnSave').on('click', function () {
                var str = editor.getString();

                $.ajax({
                    url         : "{{action('\Gdevilbat\SpardaCMS\Modules\Appearance\Http\Controllers\MenuController@store')}}",
                    data        : {
                        _token : Laravel.csrfToken,
                        menu : JSON.parse(str)
                    },
                    method      : 'POST',
                    success    : function(data){
                                window.location.reload();
                    }
                });
            });

            $("#btnUpdate").click(function(){
                editor.update();
            });

            $('#btnAdd').click(function(){
                editor.add();
            });

            $('#btnEditItem').click(function(event) {
                editor.resetForm();
                $("#text").val($("[name='taxonomy']").val());
                $("#term_id").val($("#taxonomy option:selected").attr('data-term-id'));
                $("#parent_id").val($("#taxonomy option:selected").attr('data-parent-id'));
                $("#post_id").val($("#taxonomy option:selected").attr('data-post-id'));
            });
            /* ====================================== */

            /** PAGE ELEMENTS **/
            $('[data-toggle="tooltip"]').tooltip();

            editor.setData(arrayjson);
        });
    </script>
@endsection