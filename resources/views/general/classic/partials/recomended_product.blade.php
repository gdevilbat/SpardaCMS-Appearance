<div class="blog-lists bg-light p-2 shadow-sm my-2">
	<div class="d-flex">
	    <h5 class="m-0">Recomended Product</h5>
	</div>
    <hr class="w-75 ml-1">
	@foreach($recomended_posts as $recomended_post)
	    <div class="blog-list wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
	        <div class="blog-list-image d-flex">
	        	@if(!empty($recomended_post) && !empty($recomended_post->postMeta->where('meta_key', 'feature_image')->first()) && $recomended_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
	        		<div class="w-100 transparent-layer" style="background-image: url({{url('public/storage/'.$recomended_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}})">
                        @if($recomended_post->post_type == 'post')
                            <a href="{{url($recomended_post->created_at->format('Y').'/'.$recomended_post->created_at->format('m').'/'.$recomended_post->post_slug.'.html')}}">
                                <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$recomended_post->post_title}}"> 
                            </a>
                        @else
                            <a href="{{url($recomended_post->post_type.'/'.$recomended_post->post_slug)}}">
                                <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$recomended_post->post_title}}"> 
                            </a>
                        @endif
                    </div>
	            @endif
	        </div>
	        <div class="ellipsis mb-2" style="font-size: 1.3rem">
	        	@if($recomended_post->post_type == 'post')
		        	<a href="{{url($recomended_post->created_at->format('Y').'/'.$recomended_post->created_at->format('m').'/'.$recomended_post->post_slug.'.html')}}">{{strtoupper($recomended_post->post_title)}}</a>
	        	@else
		        	<a href="{{url($recomended_post->post_type.'/'.$recomended_post->post_slug)}}">{{strtoupper($recomended_post->post_title)}}</a>
	        	@endif
	        </div>
	        <div class="blog-list-meta"> <i class="fa fa-money-bill-wave"></i> Rp. {{number_format($recomended_post->productMeta->product_price)}}</div>
	        {!!$recomended_post->post_excerpt!!}
	    </div>
    @endforeach
</div>