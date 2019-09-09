@php
    $posts_paginate = $posts_builder->paginate(8);
    $group_posts = $posts_paginate->chunk(4)
@endphp

@extends('appearance::general.classic.templates.parent')

@section('title')
    {{!empty($taxonomy->term->name) ? $taxonomy->term->name : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('content')
    <header>
        <div class="container">
            <div class="row py-2">
                <div class="col-12">
                    <div>
                          <center><h2 class="title">{{$taxonomy->term->name}}</h2></center>
                          <center><p>{{$taxonomy->description}}</p></center>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Blog-area -->
    @foreach ($group_posts as $posts)
        @if($loop->iteration % 2 > 0)
            <section id="blog-area" class="py-2">
                <div class="container">
                    <div class="row">
                        <?php $recent_post = $posts->take(1); ?>
                        <div class="col-xs-12 col-md-6 wow fadeInUp">
                            @foreach ($recent_post as $post)
                                    <div class="blog-box">
                                        <div class="blog-image">
                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                                <div class="w-100 transparent-layer" style="background-image: url({{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}})">
                                                    <a href="{{url($post->post_type.'/'.$post->post_slug)}}">
                                                        <img src="{{module_asset_url('appearance:assets/images/rectangle-50-25.png')}}" class="w-100" alt="{{$post->post_title}}"> 
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="blog-details">
                                            <h4>
                                                <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                            </h4>
                                            <div class="mb-1"><i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_price)}}</div>
                                            <p>{!!$post->post_excerpt!!}</p>
                                        </div>
                                    </div>
                            @endforeach
                        </div>

                        <?php $recent_post = $posts->slice(1); ?>
                        <div class="col-xs-12 col-md-6 wow fadeInUp">
                            @foreach ($recent_post as $post)
                                <div class="blog-lists">
                                    <div class="blog-list wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="blog-list-image">
                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                                <div class="w-100 transparent-layer" style="background-image: url({{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}})">
                                                    <a href="{{url($post->post_type.'/'.$post->post_slug)}}">
                                                        <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt=""> 
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ellipsis mb-2" style="font-size: 1.3rem">
                                            <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                        </div>
                                        <div class="blog-list-meta"> <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_price)}}</div>
                                        <p>{!!$post->post_excerpt!!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @else
            <section id="blog-area" class="py-2 bg-light">
                <div class="container">
                    <div class="row flex-row-reverse">
                        <?php $recent_post = $posts->take(1); ?>
                        <div class="col-xs-12 col-md-6 wow fadeInUp">
                            @foreach ($recent_post as $post)
                                    <div class="blog-box">
                                        <div class="blog-image">
                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                                <div class="w-100 transparent-layer" style="background-image: url({{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}})">
                                                    <a href="{{url($post->post_type.'/'.$post->post_slug)}}">
                                                        <img src="{{module_asset_url('appearance:assets/images/rectangle-50-25.png')}}" class="w-100" alt="{{$post->post_title}}"> 
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="blog-details">
                                            <h4>
                                                <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                            </h4>
                                            <div class="mb-1"><i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_price)}}</div>
                                            <p>{!!$post->post_excerpt!!}</p>
                                        </div>
                                    </div>
                            @endforeach
                        </div>

                        <?php $recent_post = $posts->slice(1); ?>
                        <div class="col-xs-12 col-md-6 wow fadeInUp">
                            @foreach ($recent_post as $post)
                                <div class="blog-lists">
                                    <div class="blog-list wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="blog-list-image">
                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                                <div class="w-100 transparent-layer" style="background-image: url({{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}})">
                                                    <a href="{{url($post->post_type.'/'.$post->post_slug)}}">
                                                        <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt=""> 
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ellipsis mb-2" style="font-size: 1.3rem">
                                            <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                        </div>
                                        <div class="blog-list-meta"> <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_price)}}</div>
                                        <p>{!!$post->post_excerpt!!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach
    <section>
        <div class="container">
            {{ $posts_paginate->links('appearance::general.classic.pagination.simple') }}
        </div>
    </section>
    <!-- Blog-area / -->
@endsection