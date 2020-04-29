@php
    $posts_paginate = $posts_builder->paginate(16);
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
                          <center><h1 class="title">{{$taxonomy->term->name}}</h1></center>
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
                        <div class="col-xs-12 col-md-6 wow fadeInUp position-relative">
                            @foreach ($recent_post as $post)
                                    <div class="blog-box">
                                        <div class="blog-image position-relative">
                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'cover_image')->first()) && $post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null)
                                                <div class="w-100 transparent-layer lazy-bg" data-src="{{generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}">
                                                        <img src="{{module_asset_url('appearance:assets/images/rectangle-50-25.png')}}" class="w-100" alt="{{$post->post_title}}"> 
                                                    </a>
                                                </div>
                                            @endif
                                            @if($post->productMeta->availability != 'in stock')
                                                <div class="position-absolute w-100 h-100 not-ready-stock d-flex justify-content-center align-items-center">
                                                    <span>{{ucwords($post->productMeta->availability)}}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="blog-details">
                                            <h2>
                                                <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                            </h2>
                                            @if($post->productMeta->discount > 0)
                                                <i class="fa fa-tags"></i> <s class="font-italic">Rp. {{number_format($post->productMeta->product_price)}}</s>
                                                <br>
                                                <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_sale)}}
                                            @else
                                                <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_price)}}
                                            @endif
                                            <p>{!!$post->post_excerpt!!}</p>
                                        </div>
                                        @if($post->productMeta->discount > 0)
                                            <div class="ribbon"><span>{{$post->productMeta->discount}}% Off</span></div>
                                        @endif
                                    </div>
                            @endforeach
                        </div>

                        <?php $recent_post = $posts->slice(1); ?>
                        <div class="col-xs-12 col-md-6 wow fadeInUp">
                            @foreach ($recent_post as $post)
                                <div class="blog-lists position-relative">
                                    <div class="blog-list wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="blog-list-image position-relative">
                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'cover_image')->first()) && $post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null)
                                                <div class="w-100 transparent-layer lazy-bg" data-src="{{generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}">
                                                        <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$post->post_title}}"> 
                                                    </a>
                                                </div>
                                            @endif
                                            @if($post->productMeta->availability != 'in stock')
                                                <div class="position-absolute w-100 h-100 not-ready-stock d-flex justify-content-center align-items-center">
                                                    <span>{{ucwords($post->productMeta->availability)}}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ellipsis mb-2" style="font-size: 1.3rem">
                                            <h2 class="header-text">
                                                <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                            </h2>
                                        </div>
                                        <div class="blog-list-meta"> 
                                            @if($post->productMeta->discount > 0)
                                                <i class="fa fa-tags"></i> <s class="font-italic">Rp. {{number_format($post->productMeta->product_price)}}</s>
                                                <br>
                                                <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_sale)}}
                                            @else
                                                <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_price)}}
                                            @endif
                                        </div>
                                        <p>{!!$post->post_excerpt!!}</p>
                                    </div>
                                    @if($post->productMeta->discount > 0)
                                        <div class="ribbon"><span>{{$post->productMeta->discount}}% Off</span></div>
                                    @endif
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
                        <div class="col-xs-12 col-md-6 wow fadeInUp position-relative">
                            @foreach ($recent_post as $post)
                                    <div class="blog-box">
                                        <div class="blog-image position-relative">
                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'cover_image')->first()) && $post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null)
                                                <div class="w-100 transparent-layer lazy-bg" data-src="{{generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}">
                                                        <img src="{{module_asset_url('appearance:assets/images/rectangle-50-25.png')}}" class="w-100" alt="{{$post->post_title}}"> 
                                                    </a>
                                                </div>
                                            @endif
                                            @if($post->productMeta->availability != 'in stock')
                                                <div class="position-absolute w-100 h-100 not-ready-stock d-flex justify-content-center align-items-center">
                                                    <span>{{ucwords($post->productMeta->availability)}}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="blog-details">
                                            <h2>
                                                <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                            </h2>
                                            @if($post->productMeta->discount > 0)
                                                <i class="fa fa-tags"></i> <s class="font-italic">Rp. {{number_format($post->productMeta->product_price)}}</s>
                                                <br>
                                                <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_sale)}}
                                            @else
                                                <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_price)}}
                                            @endif
                                            <p>{!!$post->post_excerpt!!}</p>
                                        </div>
                                        @if($post->productMeta->discount > 0)
                                            <div class="ribbon"><span>{{$post->productMeta->discount}}% Off</span></div>
                                        @endif
                                    </div>
                            @endforeach
                        </div>

                        <?php $recent_post = $posts->slice(1); ?>
                        <div class="col-xs-12 col-md-6 wow fadeInUp">
                            @foreach ($recent_post as $post)
                                <div class="blog-lists position-relative">
                                    <div class="blog-list wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="blog-list-image position-relative">
                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'cover_image')->first()) && $post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null)
                                                <div class="w-100 transparent-layer lazy-bg" data-src="{{generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}">
                                                        <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$post->post_title}}"> 
                                                    </a>
                                                </div>
                                            @endif
                                            @if($post->productMeta->availability != 'in stock')
                                                <div class="position-absolute w-100 h-100 not-ready-stock d-flex justify-content-center align-items-center">
                                                    <span>{{ucwords($post->productMeta->availability)}}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ellipsis mb-2" style="font-size: 1.3rem">
                                            <h2 class="header-text">
                                                <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                            </h2>
                                        </div>
                                        <div class="blog-list-meta"> 
                                            @if($post->productMeta->discount > 0)
                                                <i class="fa fa-tags"></i> <s class="font-italic">Rp. {{number_format($post->productMeta->product_price)}}</s>
                                                <br>
                                                <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_sale)}}
                                            @else
                                                <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($post->productMeta->product_price)}}
                                            @endif
                                        </div>
                                        <p>{!!$post->post_excerpt!!}</p>
                                    </div>
                                    @if($post->productMeta->discount > 0)
                                        <div class="ribbon"><span>{{$post->productMeta->discount}}% Off</span></div>
                                    @endif
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
            <div class="row justify-content-center">
                {{ $posts_paginate->links('appearance::general.classic.pagination.simple') }}
            </div>
        </div>
    </section>
    <!-- Blog-area / -->
@endsection