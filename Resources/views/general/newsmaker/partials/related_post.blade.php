@foreach($related_posts as $related_post)
    <div class="list">
	    <div class="caption list-content list-caption">
	        <h5>
	            <a href="{{url($related_post->created_at->format('Y').'/'.$related_post->created_at->format('m').'/'.$related_post->post_slug.'.html')}}">
	                {!!$related_post->post_excerpt!!}
	            </a>
	        </h5>
	        @foreach($related_post->taxonomies as $category)
		        <h6>
		            <a href="{{url($category->taxonomy.'/'.$category->full_slug)}}">
		                <img src="{{module_asset_url('appearance:assets/icon/love.png')}}" alt="love icon">
		                Kategory {{$category->term->name}}
		            </a>
		        </h6>
	        @endforeach
	        <ul class="list-inline">
	            <li class="list-inline-item">
	                <a href="javascript:;">
	                    <img src="{{module_asset_url('appearance:assets/icon/like.png')}}" alt="Like Icon">
	                </a>
	            </li>
	            <li class="list-inline-item">
	                <a href="javascript:;">
	                    <img src="{{module_asset_url('appearance:assets/icon/comment.png')}}" alt="Comment Icon">
	                </a>
	            </li>
	            <li class="list-inline-item">
	                <a href="javascript:;">
	                    <img src="{{module_asset_url('appearance:assets/icon/share.png')}}" alt="Share Icon">
	                </a>
	            </li>
	        </ul>
	    </div>
	    <div class="list-content list-img">
	        <a href="{{url($related_post->created_at->format('Y').'/'.$related_post->created_at->format('m').'/'.$related_post->post_slug.'.html')}}">
	        	@if(!empty($post) && !empty($post->postMeta->where('meta_key', 'cover_image')->first()) && $post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null)
		            <img src="{{generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}" alt="Judul Berita">
	            @else
		            <img src="https://dummyimage.com/600x200/084494/fff" alt="Judul Berita">
	            @endif
	        </a>
	    </div>
	</div>
@endforeach