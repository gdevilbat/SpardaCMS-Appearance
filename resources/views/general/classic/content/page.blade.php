@extends('appearance::general.classic.templates.parent')

@section('title')
    {{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('meta_tag')
    <meta name="description" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : 'SpardaCMS for Connecting Business and Technology')}}" />
    <meta name="keywords" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_keyword')->first()) && $post->postMeta->where('meta_key', 'meta_keyword')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_keyword')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_keyword']) ? $settings->where('name','global')->flatten()[0]->value['meta_keyword'] : env('APP_NAME'))}}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_title')->first()) && $post->postMeta->where('meta_key', 'fb_share_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'fb_share_title')->first()->meta_value : ((!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : 'SpardaCMS')}} | {{env('APP_NAME')}}" />
    <meta property="og:description" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_description')->first()) && $post->postMeta->where('meta_key', 'fb_share_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'fb_share_description')->first()->meta_value : (!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : 'SpardaCMS for Connecting Business and Technology')}}" />
    <meta property="og:image" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_image')->first()) && $post->postMeta->where('meta_key', 'fb_share_image')->first()->meta_value != null) ? asset($post->postMeta->where('meta_key', 'fb_share_image')->first()->meta_value) : (!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null ? Storage::url($post->postMeta->where('meta_key', 'feature_image')->first()->meta_value) : asset('public/img/LOGO_1024X1024.jpg'))}}"/>
    <meta property="og:image:alt" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : env('APP_NAME'))}}" />
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row py-2">
                <div class="col-12 py-3">
                    @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                        <img src="{{Storage::url($post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                    @endif
                    {!!$post->post_content!!}
                </div>
            </div>
        </div>
    </section>
@endsection