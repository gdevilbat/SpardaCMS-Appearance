<div class="blog-lists bg-light p-2 shadow-sm my-2">
	<div class="d-flex">
	    <h5 class="m-0">Recomended Product</h5>
	</div>
    <hr class="w-75 ml-1">
	@foreach($recomended_posts as $recomended_post)
	    <div class="blog-list wow fadeInUp position-relative" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
	        <div class="blog-list-image d-flex position-relative">
	        	@if(!empty($recomended_post) && !empty($recomended_post->postMeta->where('meta_key', 'feature_image')->first()) && $recomended_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
	        		<div class="w-100 transparent-layer lazy-bg" data-src="{{url('public/storage/'.$recomended_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}">
                        <a href="{{url($recomended_post->post_type.'/'.$recomended_post->post_slug)}}">
                            <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$recomended_post->post_title}}"> 
                        </a>
                    </div>
	            @endif
	            @if($recomended_post->productMeta->availability != 'in stock')
                    <div class="position-absolute w-100 h-100 not-ready-stock d-flex justify-content-center align-items-center">
                        <span>{{ucwords($recomended_post->productMeta->availability)}}</span>
                    </div>
                @endif
	        </div>
	        <div class="ellipsis mb-2" style="font-size: 1.3rem">
	        	<a href="{{url($recomended_post->post_type.'/'.$recomended_post->post_slug)}}">{{strtoupper($recomended_post->post_title)}}</a>
	        </div>
	        <div class="blog-list-meta"> 
                @if($recomended_post->productMeta->discount > 0)
                    <i class="fa fa-tags"></i> <s class="font-italic">Rp. {{number_format($recomended_post->productMeta->product_price)}}</s>
                    <br>
                    <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($recomended_post->productMeta->product_sale)}}
                @else
                    <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($recomended_post->productMeta->product_price)}}
                @endif
            </div>
	        {!!$recomended_post->post_excerpt!!}
	        @if($recomended_post->productMeta->discount > 0)
                <div class="ribbon"><span>{{$recomended_post->productMeta->discount}}% Off</span></div>
            @endif
	    </div>
    @endforeach
</div>