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
                <div class="col-lg-7 py-2" itemscope itemtype="http://schema.org/Store">
                    <meta itemprop="image" content="{{(module_asset_url('appearance:assets/images/default_v3-shopnophoto.png'))}}">
                    <meta itemprop="name" content="{{config('app.name')}}">
                    <div class="w-100 my-3" itemscope itemtype="http://schema.org/Product">
                        <meta itemprop="productID" content="{{str_slug(config('app.name')).'_product_'.$post->getKey()}}">
                        <meta itemprop="brand" content="{{$post_categories->first()->term->name}}">
                        <div>
                              <h1 class="upper" itemprop="name">{{$post->post_title}} </h1> 
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
                                    <span class="text-dark">{{$post->author->name}}</span>
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
                        <div class="w-100 d-flex justify-content-center">
                            @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'cover_image')->first()) && $post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null)
                                <img class="img-header d-none d-lg-block align-self-start" id="magnificier" src="{{generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}" alt="cover-{{$post->post_slug}}" itemprop="image"> 
                                <img class="img-header d-lg-none align-self-start" id="magnificier" src="{{generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}" alt="cover-{{$post->post_slug}}"> 
                            @endif
                        </div>
                        <hr>
                            <div class="col-12">
                                <div class="owl-carousel owl-theme">
                                    @foreach ($post->galleries as $gallery)
                                        <div class="item"><img class="img-fluid" src="{{generate_storage_url($gallery->photo)}}" alt="gallery-{{$post->post_slug}}-{{$loop->iteration}}"itemprop="image"> </div>
                                    @endforeach
                                </div>
                            </div>
                        <hr>
                        <div class="d-flex w-100 mb-2" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <meta itemprop="priceCurrency" content="IDR">
                            <link itemprop="availability" href="{{$post->productMeta->schema_availability}}"/>
                            <link itemprop="itemCondition" href="{{$post->productMeta->schema_condition}}"/>
                            @if($post->productMeta->discount > 0)
                                <meta itemprop="price" content="{{$post->productMeta->product_sale}}">
                                <div >
                                    <h5 class="amount mb-0">
                                        <span style="font-size: .7em;" class="font-italic"><s>Rp. {{number_format($post->productMeta->product_price)}}</s></span>
                                        <span class="text-danger" style="font-size: .8em;">-{{$post->productMeta->discount}}%</span>
                                    </h5>
                                    <h5 class="amount">
                                        <span class="font-italic">Rp. {{number_format($post->productMeta->product_sale)}}</span>
                                    </h5>
                                </div>
                            @else
                                <meta itemprop="price" content="{{$post->productMeta->product_price}}">
                                <h5 class="amount font-italic">Rp. {{number_format($post->productMeta->product_price)}}</h5>
                            @endif
                            <div class="btn-group ml-auto d-flex align-items-center" role="group">
                                @if($post->productMeta->availability == 'in stock')
                                    @php
                                        $tokopedia_store = $post->meta->getMetaData(\Gdevilbat\SpardaCMS\Modules\Ecommerce\Entities\ProductMeta::TOKPED_STORE);
                                        $shopee_store = $post->meta->getMetaData(\Gdevilbat\SpardaCMS\Modules\Ecommerce\Entities\ProductMeta::SHOPEE_STORE);
                                    @endphp
                                    @if((!empty($tokopedia_store) && $tokopedia_store->slug != '') || (!empty($shopee_store) && $shopee_store->shop_id != ''))
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 1em;">
                                              <i class="fas fa-shopping-cart"></i> Pilih Marketplace
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                              @if(!empty($tokopedia_store) && $tokopedia_store->slug != '')
                                                  <a class="dropdown-item" href="{{url('https://tokopedia.com/'.$tokopedia_store->merchant.'/'.$tokopedia_store->slug)}}" target="_blank">Tokopedia</a>
                                              @endif
                                              @if(!empty($shopee_store) && $shopee_store->shop_id != '')
                                                  <a class="dropdown-item" href="{{url('https://shopee.com/product/'.$shopee_store->shop_id.'/'.$shopee_store->product_id)}}" target="_blank">Shopee</a>
                                              @endif
                                            </div>
                                        </div>
                                    @else
                                        <a href="javascript:void(0)" class="text-reset" title="" >
                                            <button id="btnGroupDrop1" type="button" class="btn btn-dark p-1 rounded btn-shop" aria-haspopup="true" aria-expanded="false" style="height: 40px; font-size: 1em">
                                              Unavailable
                                            </button>
                                        </a>
                                    @endif
                                @else
                                    <a href="javascript:void(0)" class="text-reset" title="" >
                                        <button id="btnGroupDrop1" type="button" class="btn btn-dark p-1 rounded btn-shop" aria-haspopup="true" aria-expanded="false" style="height: 40px; font-size: .9em">
                                          {{ucwords($post->productMeta->availability)}}
                                        </button>
                                    </a>
                                @endif
                           </div>
                        </div>
                        <article itemprop="description">
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
                </div>
                <div class="col-lg-5">
                    @include('appearance::general.classic.partials.widget_product', ['widget_title' => 'Related Product', 'widget_posts' => $related_posts])
                    <div class="left-side sticky-top">
	                   @include('appearance::general.classic.partials.widget_product', ['widget_title' => 'Latest Product', 'widget_posts' => $recent_posts])
                        @include('appearance::general.classic.partials.widget_product', ['widget_title' => 'Recomended Product', 'widget_posts' => $recomended_posts])
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