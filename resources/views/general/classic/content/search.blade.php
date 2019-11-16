@php
    $posts_paginate = $posts_builder->paginate(10);
@endphp

@extends('appearance::general.classic.templates.parent')

@section('title')
    Search Result
@endsection

@section('meta_tag')
    <link rel="canonical" href="{{url('/')}}" />
@endsection

@section('content')
    <header>
        <div class="container">
            <div class="row py-2">
                <div class="col-12">
                    <div>
                          <center><h2 class="title">Search Result</h2></center>
                          <center><p>"{{Request::input('query')}}"</p></center>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Blog-area -->
    <section id="blog-area" class="py-2">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp">
                    @foreach ($googles as $post)
                        <div class="blog-lists">
                            <div class="blog-list wow fadeInUp" data-wow-delay="0.2s">
                                <div class="blog-list-image">
                                    @if(array_key_exists(0, $post['pagemap']['cse_image']))
                                        <div class="w-100 transparent-layer lazy-bg" data-src="{{$post['pagemap']['cse_image'][0]['src']}}">
                                            <a href="{{url($post->link)}}">
                                                    <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$post->post_title}}"> 
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="ellipsis mb-2" style="font-size: 1.3rem">
                                    <a href="{{url($post->link)}}">{!!$post->htmlSnippet!!}</a>
                                </div>
                                 <div class="blog-list-meta"><i class="fab fa-google"></i>&nbsp;{!!$post->htmlFormattedUrl!!}</div>
                                <p>{!!$post->htmlSnippet!!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="blog-area" class="py-2">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp">
                    @foreach ($posts_paginate as $post)
                        <div class="blog-lists">
                            <div class="blog-list wow fadeInUp" data-wow-delay="0.2s">
                                <div class="blog-list-image col-12">
                                    @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                        <div class="w-100 transparent-layer lazy-bg" data-src="{{Storage::url($post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}">
                                            @if($post->post_type == 'post')
                                                <a href="{{url($post->created_at->format('Y').'/'.$post->created_at->format('m').'/'.$post->post_slug.'.html')}}">
                                                    <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$post->post_title}}"> 
                                                </a>
                                            @else
                                                <a href="{{url($post->post_type.'/'.$post->post_slug)}}">
                                                    <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$post->post_title}}"> 
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="ellipsis mb-2" style="font-size: 1.3rem">
                                    @if($post->post_type == 'post')
                                        <a href="{{url($post->created_at->format('Y').'/'.$post->created_at->format('m').'/'.$post->post_slug.'.html')}}">{{$post->post_title}}</a>
                                    @else
                                        <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                    @endif
                                </div>
                                <div class="blog-list-meta"> <i class="icofont icofont-ui-calendar"></i>&nbsp;{{$post->created_at->format('d M Y')}}</div>
                                <p>{!!$post->post_excerpt!!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                {{ $posts_paginate->links('appearance::general.classic.pagination.simple') }}
            </div>
        </div>
    </section>
    <!-- Blog-area / -->
@endsection