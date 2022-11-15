<div class="blog-lists bg-light p-2 shadow-sm my-2">
	<div class="d-flex">
	    <h5 class="m-0">{{$widget_title}}</h5>
	</div>
    <hr class="w-75 ml-1">
	@foreach($widget_posts as $widget_post)
	    <div class="blog-list wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
	        <div class="blog-list-image d-flex">
	        	@if(!empty($widget_post) && !empty($widget_post->postMeta->where('meta_key', 'cover_image')->first()) && $widget_post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null)
	        		<div class="w-100 transparent-layer lazy-bg" data-src="{{generate_storage_url($widget_post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}">
                        <a href="{{url($widget_post->created_at->format('Y').'/'.$widget_post->created_at->format('m').'/'.$widget_post->post_slug.'.html')}}">
                            <img src="{{module_asset_url('appearance:assets/images/square-layer.png')}}" class="w-100" alt="{{$widget_post->post_title}}"> 
                        </a>
                    </div>
	            @endif
	        </div>
	        <div class="ellipsis mb-2" style="font-size: 1.3rem">
	        	<h2 class="header-text"><a href="{{url($widget_post->created_at->format('Y').'/'.$widget_post->created_at->format('m').'/'.$widget_post->post_slug.'.html')}}">{{$widget_post->post_title}}</a></h2>
	        </div class="ellipsis mb-2" style="font-size: 1.3rem">
	        <div class="blog-list-meta"> <i class="icofont icofont-ui-calendar"></i> {{$widget_post->created_at->format('d/M/Y')}}</div>
	        {!!$widget_post->post_excerpt!!}
	    </div>
    @endforeach
</div>