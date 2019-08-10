@extends('appearance::general.'.$theme_public->value.'.templates.parent')

@section('content')
    <section>
        <div class="container">
            <div class="row py-2">
                <div class="col-12">
                    <div>
                          <center><h2 class="title">{{$taxonomy->term->name}}</h2></center>
                          <center><p>{{$taxonomy->term->term}}</p></center>
                    </div>
                    <!-- Blog-area -->
                    <?php $group_posts = $posts->chunk(4) ?>
                    @foreach ($group_posts as $posts)
                        @if($loop->iteration % 2 > 0)
                            <section id="blog-area" class="my-1">
                                <div class="container">
                                    <div class="row">
                                        <?php $recent_post = $posts->take(1); ?>
                                        <div class="col-xs-12 col-md-6 wow fadeInUp">
                                            @foreach ($recent_post as $post)
                                                    <div class="blog-box">
                                                        <div class="blog-image">
                                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                                                <img src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                                                            @endif
                                                        </div>
                                                        <div class="blog-details">
                                                            <h4>
                                                                @if($post->post_type == 'post')
                                                                    <a href="{{url($post->created_at->format('Y').'/'.$post->created_at->format('m').'/'.$post->post_slug.'.html')}}">{{$post->post_title}}</a>
                                                                @else
                                                                    <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                                                @endif
                                                            </h4>
                                                            <p>{{$post->post_excerpt}}</p>
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
                                                            <img src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                                                            @endif
                                                        </div>
                                                        <h5>
                                                            @if($post->post_type == 'post')
                                                                <a href="{{url($post->created_at->format('Y').'/'.$post->created_at->format('m').'/'.$post->post_slug.'.html')}}">{{$post->post_title}}</a>
                                                            @else
                                                                <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                                            @endif
                                                        </h5>
                                                        <div class="blog-list-meta"> <i class="icofont icofont-ui-calendar"></i> {{$post->created_at->format('d M Y')}}</div>
                                                        <p>{{$post->post_excerpt}}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @else
                            <section id="blog-area" class="my-1" class="bg-white">
                                <div class="container">
                                    <div class="row flex-row-reverse">
                                        <?php $recent_post = $posts->take(1); ?>
                                        <div class="col-xs-12 col-md-6 wow fadeInUp">
                                            @foreach ($recent_post as $post)
                                                    <div class="blog-box">
                                                        <div class="blog-image">
                                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                                                <img src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                                                            @endif
                                                        </div>
                                                        <div class="blog-details">
                                                            <h4>
                                                                @if($post->post_type == 'post')
                                                                    <a href="{{url($post->created_at->format('Y').'/'.$post->created_at->format('m').'/'.$post->post_slug.'.html')}}">{{$post->post_title}}</a>
                                                                @else
                                                                    <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                                                @endif
                                                            </h4>
                                                            <p>{{$post->post_excerpt}}</p>
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
                                                            <img src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                                                            @endif
                                                        </div>
                                                        <h5>
                                                            @if($post->post_type == 'post')
                                                                <a href="{{url($post->created_at->format('Y').'/'.$post->created_at->format('m').'/'.$post->post_slug.'.html')}}">{{$post->post_title}}</a>
                                                            @else
                                                                <a href="{{url($post->post_type.'/'.$post->post_slug)}}">{{$post->post_title}}</a>
                                                            @endif
                                                        </h5>
                                                        <div class="blog-list-meta"> <i class="icofont icofont-ui-calendar"></i> {{$post->created_at->format('d M Y')}}</div>
                                                        <p>{{$post->post_excerpt}}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif
                    @endforeach
                    <!-- Blog-area / -->
                </div>
            </div>
        </div>
    </section>
@endsection