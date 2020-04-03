@extends('appearance::general.classic.templates.parent')

@section('title')
    {{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('meta_tag')
    <meta name="description" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : 'SpardaCMS for Connecting Business and Technology')}}" />
    <meta name="keywords" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_keyword')->first()) && $post->postMeta->where('meta_key', 'meta_keyword')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_keyword')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_keyword']) ? $settings->where('name','global')->flatten()[0]->value['meta_keyword'] : env('APP_NAME'))}}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_title')->first()) && $post->postMeta->where('meta_key', 'fb_share_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'fb_share_title')->first()->meta_value : ((!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : "SpardaCMS")}} | {{env('APP_NAME')}}" />
    <meta property="og:description" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_description')->first()) && $post->postMeta->where('meta_key', 'fb_share_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'fb_share_description')->first()->meta_value : (!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : 'SpardaCMS for Connecting Business and Technology')}}" />
    <meta property="og:image" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_image')->first()) && $post->postMeta->where('meta_key', 'fb_share_image')->first()->meta_value != null) ? asset($post->postMeta->where('meta_key', 'fb_share_image')->first()->meta_value) : (!empty($post) && !empty($post->postMeta->where('meta_key', 'cover_image')->first()) && $post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null ? generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file']) : '')}}"/>
    <meta property="og:image:alt" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : env('APP_NAME'))}}" />
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
                            <div class="mx-3">
                                @if(empty($post->author->profile_image_url))
                                    <img src="{{module_asset_url('core:assets/images/atomix_user31.png')}}" style="max-width: 20px" alt="avatar" />
                                @else
                                    <img src="{{generate_storage_url($post->author->profile_image_url)}}" style="max-width: 20px" alt="avatar"> 
                                @endif
                            </div>
                            <div class="col pl-0">
                                <span class="text-dark">{{$post->author->name}}</span> | <span class="text-dark"><i class="fa fa-clock"></i> {{$post->created_at}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="my-1">
                        @foreach ($post_categories as $category)
                            <a href="{{url($category->taxonomy.'/'.$category->full_slug)}}" title=""><span class="badge badge-danger mx-1">{{$category->term->name}}</span></a>
                        @endforeach
                    </div>
                    <div class="w-100 justify-content-center">
	                    @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'cover_image')->first()) && $post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null)
	                        <img class="magnificier" src="{{generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}" alt="cover-{{$post->post_slug}}"> 
	                    @endif
                    </div>
                    {!!$post->post_content!!}
                    <div class="my-2 d-flex">
                        <span>TAGS : </span>
                        @foreach ($post_tags as $tag)
                            <a href="{{url($tag->taxonomy.'/'.$tag->full_slug)}}" title=""><span class="badge badge-warning mx-1">{{$tag->term->name}}</span></a>
                        @endforeach
                    </div>
                    @if($post->comment_status == 'open')
	                    <hr>
	                    <div class="col-12">
	                    	<div id="disqus_thread"></div>
	                    </div>
                    @endif
                </div>
                <div class="col-lg-5">
                    @include('appearance::general.classic.partials.related_post')
                    @include('appearance::general.classic.partials.recent_post')
                    @include('appearance::general.classic.partials.recomended_post')
                    @include('appearance::general.classic.partials.category_widget')
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page_level_js')
    {{Html::script(module_asset_url('appearance:resources/views/general/classic/js/plugin/jquery.zoom.min.js'))}}
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