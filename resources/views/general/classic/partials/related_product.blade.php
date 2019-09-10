<div class="blog-lists bg-light p-2 shadow-sm my-2">
	<div class="d-flex">
	    <h5 class="m-0">Related Product</h5>
	</div>
    <hr class="w-75 ml-1">
	@foreach($related_posts as $related_post)
	    <div class="blog-list wow fadeInUp position-relative" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
	        <div class="blog-list-image d-flex">
	        	@if(!empty($related_post) && !empty($related_post->postMeta->where('meta_key', 'feature_image')->first()) && $related_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
	        		<div class="w-100 transparent-layer" style="background-image: url({{url('public/storage/'.$related_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}})">
                        <a href="{{url($related_post->post_type.'/'.$related_post->post_slug)}}">
                            <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$related_post->post_title}}"> 
                        </a>
                    </div>
	            @endif
	        </div>
	        <div class="ellipsis mb-2" style="font-size: 1.3rem">
	        	<a href="{{url($related_post->post_type.'/'.$related_post->post_slug)}}">{{strtoupper($related_post->post_title)}}</a>
	        </div>
	        <div class="blog-list-meta"> 
                @if($related_post->productMeta->discount > 0)
                    <i class="fa fa-tags"></i> <s class="font-italic">Rp. {{number_format($related_post->productMeta->product_sale)}}</s>
                    <br>
                    <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($related_post->productMeta->product_price)}}
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