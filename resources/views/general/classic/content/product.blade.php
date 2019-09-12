@extends('appearance::general.classic.templates.parent')

@section('title')
    {{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('meta_tag')
    <meta name="description" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : 'SpardaCMS for Connecting Business and Technology')}}" />
    <meta name="keywords" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_keyword')->first()) && $post->postMeta->where('meta_key', 'meta_keyword')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_keyword')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_keyword']) ? $settings->where('name','global')->flatten()[0]->value['meta_keyword'] : env('APP_NAME'))}}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_title')->first()) && $post->postMeta->where('meta_key', 'fb_share_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'fb_share_title')->first()->meta_value : ((!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : 'SpardaCMS')}} | {{env('APP_NAME')}}"/>
    <meta property="og:description" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_description')->first()) && $post->postMeta->where('meta_key', 'fb_share_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'fb_share_description')->first()->meta_value : (!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : 'SpardaCMS for Connecting Business and Technology')}}" />
    <meta property="og:image" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_image')->first()) && $post->postMeta->where('meta_key', 'fb_share_image')->first()->meta_value != null) ? asset($post->postMeta->where('meta_key', 'fb_share_image')->first()->meta_value) : (!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null ? url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value) : asset('public/img/LOGO_1024X1024.jpg'))}}"/>
    <meta property="og:image:alt" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : env('APP_NAME'))}}" />
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row py-2">
                <div class="col-lg-7 py-2" itemscope itemtype="http://schema.org/Store">
                    <meta itemprop="image" content="{{(module_asset_url('appearance:assets/images/default_v3-shopnophoto.png'))}}">
                    <meta itemprop="name" content="{{env('APP_NAME')}}">
                    <div class="w-100" itemscope itemtype="http://schema.org/Product">
                        <meta itemprop="productID" content="{{env('APP_NAME').'_product_'.$post->getKey()}}">
                        <div>
                              <h3 class="upper" itemprop="name">{{$post->post_title}} </h3> 
                        </div>
                        <div class="my-2 border-top border-bottom">
                            <div class="row px-2 py-1">
                                <div class="mx-3">
                                    @if(empty($post->author->profile_image_url))
                                        <img src="{{module_asset_url('core:assets/images/atomix_user31.png')}}" style="max-width: 20px" alt="" />
                                    @else
                                        <img src="{{url('public/storage/'.$post->author->profile_image_url)}}" style="max-width: 20px" alt=""> 
                                    @endif
                                </div>
                                <div class="col pl-0">
                                    <span class="text-dark">{{$post->author->name}}</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="my-1">
                            @foreach ($post_categories as $category)
                                <a href="{{url($category->taxonomy.'/'.$category->full_slug)}}" title=""><span class="badge badge-danger mx-1">{{$category->term->name}}</span></a>
                            @endforeach
                        </div>
                        @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                            <img class="img-header d-none d-lg-block" id="magnificier" src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt="" itemprop="image"> 
                            <img class="img-header d-lg-none" id="magnificier" src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt="" itemprop="image"> 
                        @endif
                        <hr>
                            <div class="col-12">
                                <div class="owl-carousel owl-theme">
                                    @foreach ($post->galleries as $gallery)
                                        <div class="item"><img class="img-fluid" src="{{url($gallery->photo)}}" alt=""> </div>
                                    @endforeach
                                </div>
                            </div>
                        <hr>
                        <div class="d-flex w-100 mb-2" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <meta itemprop="priceCurrency" content="IDR">
                            <link itemprop="availability" href="{{$post->productMeta->schema_availability}}"/>
                            <link itemprop="itemCondition" href="{{$post->productMeta->schema_condition}}"/>
                            @if($post->productMeta->discount > 0)
                                <div >
                                    <h3 class="amount mb-0">
                                        <span style="font-size: .7em;" class="font-italic"><s>Rp. {{number_format($post->productMeta->product_price)}}</s></span>
                                        <span class="text-danger" style="font-size: .8em;" itemprop="price" content="{{$post->productMeta->discount}}">-{{$post->productMeta->discount}}%</span>
                                    </h3>
                                    <h3 class="amount">
                                        <span class="font-italic">Rp. {{number_format($post->productMeta->product_sale)}}</span>
                                    </h3>
                                </div>
                            @else
                                <h3 class="amount font-italic" itemprop="price" content="{{$post->productMeta->product_price}}">Rp. {{number_format($post->productMeta->product_price)}}</h3>
                            @endif
                            <div class="btn-group ml-auto d-flex align-items-center" role="group">
                                @if(!empty($post->tokopedia_slug))
                                    @if($post->productMeta->availability == 'in stock')
                                        <a href="{{url('https://tokopedia.com/sparda-store/'.$post->tokopedia_slug)}}" class="text-reset" title="" target="_blank">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-danger p-1 rounded btn-shop" aria-haspopup="true" aria-expanded="false" style="height: 40px; font-size: .9em">
                                              <i class="fas fa-shopping-cart"></i> Buy Now
                                            </button>
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="text-reset" title="" >
                                            <button id="btnGroupDrop1" type="button" class="btn btn-dark p-1 rounded btn-shop" aria-haspopup="true" aria-expanded="false" style="height: 40px; font-size: .9em">
                                              {{ucwords($post->productMeta->availability)}}
                                            </button>
                                        </a>
                                    @endif
                                @endif
                           </div>
                        </div>
                        <div itemprop="description">
                            {!!$post->post_content!!}
                        </div>
                        <div class="my-2 d-flex">
                            <span>TAGS : </span>
                            @foreach ($post_tags as $tag)
                                <a href="{{url($tag->taxonomy.'/'.$tag->full_slug)}}" title=""><span class="badge badge-warning mx-1">{{$tag->term->name}}</span></a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    @include('appearance::general.classic.partials.related_product')
                    @include('appearance::general.classic.partials.recent_product')
                    @include('appearance::general.classic.partials.recomended_product')
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
            $('#magnificier')
            .wrap('<span style="display:inline-block"></span>')
            .css('display', 'block')
            .parent()
            .zoom(); 

            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                autoplay: true,
                nav: true,
                autoplayTimeOut: 1000,
                autoplayHoverPause: true,
                responsive:{
                    0:{
                        items:3
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:5
                    }
                },
                onInitialized: updateImageHeader,
                onResized: updateImageHeader
            })
        });

        function updateImageHeader(){
            $('.owl-carousel .item img').click(function(event) {
                $('#magnificier').trigger('zoom.destroy');
                $('.img-header').attr('src', $(this).attr('src'));
                $('#magnificier')
                    .css('display', 'block')
                    .parent()
                    .zoom();
            });
        }
    </script>
@endsection