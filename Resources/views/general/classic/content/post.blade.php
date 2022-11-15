@extends('appearance::general.classic.templates.parent')

@section('title')
    {{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('meta_tag')
    @include('appearance::general.classic.partials.post_meta_tag')
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row py-2">
                <div class="col-lg-7 py-2">
                    <div>
                          <h1 class="upper">{{$post->post_title}} </h1> 
                    </div>
                    <div class="my-2 border-top border-bottom">
                        <div class="row px-2 py-1">
                            <div class="d-flex align-items-center ml-3 mr-1">
                                @if(empty($post->author->profile_image_url))
                                    <img src="{{module_asset_url('core:assets/images/atomix_user31.png')}}" style="max-width: 20px" alt="avatar" />
                                @else
                                    <img src="{{generate_storage_url($post->author->profile_image_url)}}" style="max-width: 20px" alt="avatar"> 
                                @endif
                            </div>
                            <div class="d-flex align-items-center pl-0">
                                <span class="text-dark">{{$post->author->name}}</span>&nbsp;|&nbsp;<span class="text-dark"><i class="fa fa-clock"></i> {{$post->created_at->format('Y-m-d')}}</span>
                            </div>
                            <div class="col ml-auto text-right">
                                <span class="text-dark">Share : 
                                    <a href="https://www.facebook.com/sharer/sharer.php?{{http_build_query(['u' => request()->url()])}}" target="_blank" title="">
                                        <img src="{{module_asset_url('appearance:assets/images/facebook-icon.png')}}" style="max-width: 30px" alt="icon-facebook-share">
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?{{http_build_query(['url' => request()->url()])}}"  target="_blank"title="">
                                        <img src="{{module_asset_url('appearance:assets/images/twitter-icon.png')}}" style="max-width: 30px" alt="icon-twitter-share">
                                    </a>
                                    <a href="whatsapp://send/?text={{urlencode(request()->url())}}" data-action="share/whatsapp/share" target="_blank" title="">
                                        <img src="{{module_asset_url('appearance:assets/images/social-whatsapp.png')}}" style="max-width: 30px" alt="icon-whatsapp-share">
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="my-1">
                        @foreach ($post_categories as $category)
                            <a href="{{url($category->taxonomy.'/'.$category->full_slug)}}" title=""><span class="badge badge-danger mx-1">{{$category->term->name}}</span></a>
                        @endforeach
                    </div>
                    <div class="w-100 my-3 d-flex justify-content-center">
	                    @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'cover_image')->first()) && $post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null)
	                        <img class="magnificier" src="{{generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}" alt="cover-{{$post->post_slug}}"> 
	                    @endif
                    </div>
                    <article>
	                    {!!$post->post_content!!}
                    </article>
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
                    @include('appearance::general.classic.partials.widget_post', ['widget_title' => 'Related Post', 'widget_posts' => $related_posts])
                	<div class="left-side sticky-top">
                        @include('appearance::general.classic.partials.widget_post', ['widget_title' => 'Latest Post', 'widget_posts' => $recent_posts])
                        @include('appearance::general.classic.partials.widget_post', ['widget_title' => 'Recomended Post', 'widget_posts' => $recomended_posts])
	                    @include('appearance::general.classic.partials.category_widget')
                	</div>
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
          magnificier();
        });

        function magnificier() {
            $('img.magnificier').each(function(index, item) {
               if($(this).parent('span').length == 0)
                {
                    $(item)
                    .wrap('<span style="display:inline-block"></span>')
                    .css('display', 'block')
                    .parent()
                    .zoom();
                }
                else
                {
                    $(item).trigger('zoom.destroy');
                    $(item)
                    .css('display', 'block')
                    .parent()
                    .zoom();
                }
            });
        }
    </script>
@endsection