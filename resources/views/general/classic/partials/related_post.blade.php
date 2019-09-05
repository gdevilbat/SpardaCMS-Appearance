<div class="blog-lists bg-light p-2 shadow-sm my-2">
	<div class="d-flex">
	    <h5 class="m-0">Related Post</h5>
	</div>
    <hr class="w-75 ml-1">
	@foreach($related_posts as $related_post)
	    <div class="blog-list wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
	        <div class="blog-list-image d-flex">
	        	@if(!empty($related_post) && !empty($related_post->postMeta->where('meta_key', 'feature_image')->first()) && $related_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
	        		<div class="w-100 transparent-layer" style="background-image: url({{url('public/storage/'.$related_post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}})">
                        <a href="{{url($related_post->created_at->format('Y').'/'.$related_post->created_at->format('m').'/'.$related_post->post_slug.'.html')}}">
                            <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$related_post->post_title}}"> 
                        </a>
	                </div>
	            @endif
	        </div>
	        <div class="ellipsis mb-2" style="font-size: 1.3rem">
	        	<a href="{{url($related_post->created_at->format('Y').'/'.$related_post->created_at->format('m').'/'.$related_post->post_slug.'.html')}}">{{$related_post->post_title}}</a>
	        </div class="ellipsis mb-2" style="font-size: 1.3rem">
	        <div class="blog-list-meta"> <i class="icofont icofont-ui-calendar"></i> {{$related_post->created_at->format('d/M/Y')}}</div>
	        {!!$related_post->post_excerpt!!}
	    </div>
    @endforeach
</div>