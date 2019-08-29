<div class="blog-lists bg-light p-2 shadow-sm my-2">
	<div class="d-flex">
	    <h5 class="m-0">Latest Product</h5>
	</div>
    <hr class="w-75 ml-1">
	@foreach($recent_posts as $recent_post)
	    <div class="blog-list wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
	        <div class="blog-list-image d-flex">
	        	@if(!empty($recent_post) && !empty($recent_post->postMeta->where('meta_key', 'feature_image')->first()) && $recent_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
	        		<div class="w-100 transparent-layer" style="background-image: url({{url('public/storage/'.$recent_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}})">
                        <a href="{{url($recent_post->post_type.'/'.$recent_post->post_slug)}}" title="{{$recent_post->post_title}}">
                            <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100 align-self-center" alt=""> 
                        </a> 
                    </div>
	            @endif
	        </div>
	        <div class="ellipsis mb-2" style="font-size: 1.3rem">
	        	@if($recent_post->post_type == 'post')
		        	<a href="{{url($recent_post->created_at->format('Y').'/'.$recent_post->created_at->format('m').'/'.$recent_post->post_slug.'.html')}}">{{strtoupper($recent_post->post_title)}}</a>
	        	@else
		        	<a href="{{url($recent_post->post_type.'/'.$recent_post->post_slug)}}">{{strtoupper($recent_post->post_title)}}</a>
	        	@endif
	        </div>
	        <div class="blog-list-meta"> <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($recent_post->productMeta->product_price)}}</div>
	        {!!$recent_post->post_excerpt!!}
	    </div>
    @endforeach
</div>