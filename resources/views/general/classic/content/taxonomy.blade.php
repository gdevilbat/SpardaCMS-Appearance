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
                            <section id="blog-area">
                                <div class="container">
                                    <div class="row">
                                        @foreach ($posts as $post)
                                            @if($loop->index == 0)
                                                <div class="col-xs-12 col-md-6 wow fadeInUp">
                                                    <div class="blog-box">
                                                        <div class="blog-image">
                                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                                                <img src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                                                            @endif
                                                        </div>
                                                        <div class="blog-details">
                                                            <h4><a href="{{action('\Gdevilbat\SpardaCMS\Modules\Blog\Http\Controllers\BlogController@blog', ['year' => $post->created_at->format('Y'), 'month' => $post->created_at->format('m'), 'slug' => $post->post_slug])}}">{{$post->post_title.', '. $post->created_at->format('d M Y')}}</a></h4>
                                                            <p>{{$post->post_excerpt}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="blog-lists">
                                                        <div class="blog-list wow fadeInUp" data-wow-delay="0.2s">
                                                            <div class="blog-list-image">
                                                                @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                                                <img src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                                                                @endif
                                                            </div>
                                                            <h5><a href="{{action('\Gdevilbat\SpardaCMS\Modules\Blog\Http\Controllers\BlogController@blog', ['year' => $post->created_at->format('Y'), 'month' => $post->created_at->format('m'), 'slug' => $post->post_slug])}}">{{$post->post_title}}</a></h5>
                                                            <div class="blog-list-meta"> <i class="icofont icofont-ui-calendar"></i> {{$post->created_at->format('d M Y')}}</div>
                                                            <p>{{$post->post_excerpt}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        @else
                            <section id="blog-area" class="bg-white">
                                <div class="container">
                                    <div class="row">
                                        @foreach ($posts as $post)
                                            @if($loop->index == 0)
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="blog-lists">
                                                        <div class="blog-list wow fadeInUp" data-wow-delay="0.2s">
                                                            <div class="blog-list-image">
                                                                @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                                                <img src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                                                                @endif
                                                            </div>
                                                            <h5><a href="{{action('\Gdevilbat\SpardaCMS\Modules\Blog\Http\Controllers\BlogController@blog', ['year' => $post->created_at->format('Y'), 'month' => $post->created_at->format('m'), 'slug' => $post->post_slug])}}">{{$post->post_title}}</a></h5>
                                                            <div class="blog-list-meta"> <i class="icofont icofont-ui-calendar"></i> {{$post->created_at->format('d M Y')}}</div>
                                                            <p>{{$post->post_excerpt}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-xs-12 col-md-6 wow fadeInUp">
                                                    <div class="blog-box">
                                                        <div class="blog-image">
                                                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                                                                <img src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                                                            @endif
                                                        </div>
                                                        <div class="blog-details">
                                                            <h4><a href="{{action('\Gdevilbat\SpardaCMS\Modules\Blog\Http\Controllers\BlogController@blog', ['year' => $post->created_at->format('Y'), 'month' => $post->created_at->format('m'), 'slug' => $post->post_slug])}}">{{$post->post_title.', '. $post->created_at->format('d M Y')}}</a></h4>
                                                            <p>{{$post->post_excerpt}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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