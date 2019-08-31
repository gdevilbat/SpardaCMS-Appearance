@extends('appearance::general.classic.templates.parent')

@section('title')
    {{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('page_level_css')

@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row py-2">
                <div class="col-lg-7 py-2">
                    <div>
                          <h3 class="upper">{{$post->post_title}} </h3> 
                    </div>
                    <div class="my-2 border-top border-bottom">
                        <div class="row px-2 py-1">
                            <div class="col-1">
                                @if(empty($post->author->profile_image_url))
                                    <img src="{{module_asset_url('core:assets/images/atomix_user31.png')}}" class="img-fluid" alt="" />
                                @else
                                    <img src="{{url('public/storage/'.$post->author->profile_image_url)}}" class="img-fluid" alt=""> 
                                @endif
                            </div>
                            <div class="col">
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
                        <img class="img-header d-none d-lg-block" id="magnificier" src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                        <img class="img-header d-lg-none" id="magnificier" src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
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
                    <div class="d-flex w-100">
                        <h3 class="amount font-italic">Rp. {{number_format($post->productMeta->product_price)}}</h3>
                        <div class="btn-group ml-auto" role="group">
                            @if(!empty($post->tokopedia_slug))
                                <a href="{{url('https://tokopedia.com/sparda-store/'.$post->tokopedia_slug)}}" class="text-reset" title="" target="_blank">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-danger p-1 rounded-0" aria-haspopup="true" aria-expanded="false" style="height: 40px; font-size: .9em">
                                      <i class="fas fa-shopping-cart"></i> Buy Now
                                    </button>
                                </a>
                            @endif
                       </div>
                    </div>
                    {!!$post->post_content!!}
                    <div class="my-2 d-flex">
                        <span>TAGS : </span>
                        @foreach ($post_tags as $tag)
                            <a href="{{url($tag->taxonomy.'/'.$tag->full_slug)}}" title=""><span class="badge badge-warning mx-1">{{$tag->term->name}}</span></a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5">
                    @include('appearance::general.classic.partials.recent_product')
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