<div class="blog-lists bg-light p-2 shadow-sm my-2">
	<div class="d-flex">
	    <h5 class="m-0">Latest Product</h5>
	</div>
    <hr class="w-75 ml-1">
	@foreach($recent_posts as $recent_post)
	    <div class="blog-list wow fadeInUp position-relative" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
	        <div class="blog-list-image d-flex position-relative">
	        	@if(!empty($recent_post) && !empty($recent_post->postMeta->where('meta_key', 'feature_image')->first()) && $recent_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
	        		<div class="w-100 transparent-layer lazy-bg" data-src="{{url('public/storage/'.$recent_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}">
                        <a href="{{url($recent_post->post_type.'/'.$recent_post->post_slug)}}">
                            <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$recent_post->post_title}}"> 
                        </a>
                    </div>
	            @endif
	            @if($recent_post->productMeta->availability != 'in stock')
                    <div class="position-absolute w-100 h-100 not-ready-stock d-flex justify-content-center align-items-center">
                        <span>{{ucwords($recent_post->productMeta->availability)}}</span>
                    </div>
                @endif
	        </div>
	        <div class="ellipsis mb-2" style="font-size: 1.3rem">
	        	<a href="{{url($recent_post->post_type.'/'.$recent_post->post_slug)}}">{{strtoupper($recent_post->post_title)}}</a>
	        </div>
	        <div class="blog-list-meta"> 
                @if($recent_post->productMeta->discount > 0)
                    <i class="fa fa-tags"></i> <s class="font-italic">Rp. {{number_format($recent_post->productMeta->product_price)}}</s>
                    <br>
                    <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($recent_post->productMeta->product_sale)}}
                @else
                    <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($recent_post->productMeta->product_price)}}
                @endif
            </div>
	        {!!$recent_post->post_excerpt!!}
	        @if($recent_post->productMeta->discount > 0)
                <div class="ribbon"><span>{{$recent_post->productMeta->discount}}% Off</span></div>
            @endif
	    </div>
    @endforeach
</div>