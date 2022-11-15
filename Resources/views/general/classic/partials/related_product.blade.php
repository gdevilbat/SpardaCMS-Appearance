<div class="blog-lists bg-light p-2 shadow-sm my-2">
	<div class="d-flex">
	    <h5 class="m-0">Related Product</h5>
	</div>
    <hr class="w-75 ml-1">
	@foreach($related_posts as $related_post)
	    <div class="blog-list wow fadeInUp position-relative" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
	        <div class="blog-list-image d-flex position-relative">
	        	@if(!empty($related_post) && !empty($related_post->postMeta->where('meta_key', 'cover_image')->first()) && $related_post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null)
                    <div class="w-100 transparent-layer lazy-bg" data-src="{{generate_storage_url($related_post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}">
                        <a href="{{url($related_post->post_type.'/'.$related_post->post_slug)}}">
                            <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$related_post->post_title}}"> 
                        </a>
                    </div>
                @endif
	            @if($related_post->productMeta->availability != 'in stock')
                    <div class="position-absolute w-100 h-100 not-ready-stock d-flex justify-content-center align-items-center">
                        <span>{{ucwords($related_post->productMeta->availability)}}</span>
                    </div>
                @endif
	        </div>
	        <div class="ellipsis mb-2" style="font-size: 1.3rem">
	        	<h2 class="header-text"><a href="{{url($related_post->post_type.'/'.$related_post->post_slug)}}">{{strtoupper($related_post->post_title)}}</a></h2>
	        </div>
	        <div class="blog-list-meta"> 
                @if($related_post->productMeta->discount > 0)
                    <i class="fa fa-tags"></i> <s class="font-italic">Rp. {{number_format($related_post->productMeta->product_price)}}</s>
                    <br>
                    <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($related_post->productMeta->product_sale)}}
                @else
                    <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($related_post->productMeta->product_price)}}
                @endif
            </div>
	        {!!$related_post->post_excerpt!!}
	        @if($related_post->productMeta->discount > 0)
                <div class="ribbon"><span>{{$related_post->productMeta->discount}}% Off</span></div>
            @endif
	    </div>
    @endforeach
</div>