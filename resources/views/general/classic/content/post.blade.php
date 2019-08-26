@extends('appearance::general.'.$theme_public->value.'.templates.parent')

@section('title')
    {{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row py-2">
                <div class="col-lg-7 py-2">
                    <div>
                          <h3 class="upper">{{$post->post_title}} </h3> 
                    </div>
                    <div class="my-2 border-top border-bottom">
                        <div class="row px-2 py-1">
                            <div class="col-1">
                                @if(empty($post->author->profile_image_url))
                                    <img src="{{module_asset_url('core:assets/images/atomix_user31.png')}}" class="img-fluid" alt="" />
                                @else
                                    <img src="{{url('public/storage/'.$post->author->profile_image_url)}}" class="img-fluid" alt=""> 
                                @endif
                            </div>
                            <div class="col">
                                <span class="text-dark">{{$post->author->name}}</span> | <span class="text-dark"><i class="fa fa-clock"></i> {{$post->created_at}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="my-1">
                        @foreach ($post_categories as $category)
                            <a href="{{url($category->taxonomy.'/'.$category->full_slug)}}" title=""><span class="badge badge-danger mx-1">{{$category->term->name}}</span></a>
                        @endforeach
                    </div>
                    @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                        <img class="magnificier" src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                    @endif
                    {!!$post->post_content!!}
                    <div class="my-2 d-flex">
                        <span>TAGS : </span>
                        @foreach ($post_tags as $tag)
                            <a href="{{url($tag->taxonomy.'/'.$tag->full_slug)}}" title=""><span class="badge badge-warning mx-1">{{$tag->term->name}}</span></a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5">
                    @include('appearance::general.'.$theme_public->value.'.partials.recent_post')
                    @include('appearance::general.'.$theme_public->value.'.partials.category_widget')
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page_level_js')
    {{Html::script(module_asset_url('appearance:resources/views/general/'.$theme_public->value.'/js/plugin/jquery.zoom.min.js'))}}
@endsection

@section('page_script_js')
    <script type="text/javascript">
        $(document).ready(function(){
          $('img.magnificier')
            .wrap('<span style="display:inline-block"></span>')
            .css('display', 'block')
            .parent()
            .zoom();
        });
    </script>
@endsection