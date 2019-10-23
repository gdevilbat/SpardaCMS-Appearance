@extends('appearance::general.newsmaker.templates.parent')

@section('title')
    {{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('meta_tag')
    <meta name="description" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : 'SpardaCMS for Connecting Business and Technology')}}" />
    <meta name="keywords" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_keyword')->first()) && $post->postMeta->where('meta_key', 'meta_keyword')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_keyword')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_keyword']) ? $settings->where('name','global')->flatten()[0]->value['meta_keyword'] : env('APP_NAME'))}}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_title')->first()) && $post->postMeta->where('meta_key', 'fb_share_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'fb_share_title')->first()->meta_value : ((!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : "SpardaCMS")}} | {{env('APP_NAME')}}" />
    <meta property="og:description" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_description')->first()) && $post->postMeta->where('meta_key', 'fb_share_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'fb_share_description')->first()->meta_value : (!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : 'SpardaCMS for Connecting Business and Technology')}}" />
    <meta property="og:image" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_image')->first()) && $post->postMeta->where('meta_key', 'fb_share_image')->first()->meta_value != null) ? asset($post->postMeta->where('meta_key', 'fb_share_image')->first()->meta_value) : (!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null ? url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value) : '')}}"/>
    <meta property="og:image:alt" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : env('APP_NAME'))}}" />
@endsection

@section('content')
	<div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lorem ipsum dolor, sit amet consectetur</li>
            </ol>
        </nav>
    </div>
	<div class="col-md-7">
		<section id="detail">
	        <div class="heading">
	            <h5>
	                {{$post->post_title}}
	            </h5>
	        </div>
	        <div class="row sub-heading">
	            <div class="col-md-8 col-12 date">
	                {{$post->created_at->format('D, d M Y H:i')}} WIB
	            </div>
	            <div class="col-md-4 col-12 sharing-button">
	                <a href="javascript:;" class="btn btn-facebook"><img src="{{module_asset_url('appearance:assets/icon/fb-h.png')}}" alt="Facebook Share"></a>
	                <a href="javascript:;" class="btn btn-twitter"><img src="{{module_asset_url('appearance:assets/icon/twitter-wh.png')}}" alt="Facebook Share"></a>
	                <a href="javascript:;" class="btn btn-linkedin"><img src="{{module_asset_url('appearance:assets/icon/linkedin-h.png')}}" alt="Facebook Share"></a>
	            </div>
	        </div>
	        <div class="detail">
	            <div class="detail-img">
	                @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
		                <img src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt="Judul Berita">
                    @endif
	            </div>
	            <div class="detail-paragraf">
	                {!!$post->post_content!!}
	            </div>
	        </div>

	        <div class="tag-session">
	            <div class="heading">
	                <h5>Tags</h5>
	            </div>
	            @foreach ($post_tags as $tag)
		            <a href="{{url($tag->taxonomy.'/'.$tag->full_slug)}}" class="btn btn-tag">{{$tag->term->name}}</a>
                @endforeach
	        </div>

	        <section id="detail-other">
                <div class="heading-bold heading-border-bottom">
                    <h5>Related News</h5>
                </div>
		        @include('appearance::general.newsmaker.partials.related_post')
            </section>


	    </section>
	</div>
@endsection