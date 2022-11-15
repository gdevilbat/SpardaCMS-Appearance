@php
	$query = \Gdevilbat\SpardaCMS\Modules\Post\Entities\Post::with(['postMeta', 'taxonomies' => function($query){
											$query->where('taxonomy', 'category');
										}])
                                        ->where(['post_type' => 'post'])
                                        ->inRandomOrder()
                                        ->limit(3);

    if(!Auth::check())
    {
     $query = $query->where('post_status',  'publish');
    }

    $recomended_posts = $query->get();	
@endphp

@foreach ($recomended_posts as $recomended_post)
	<div class="list list-title">
	    <div class="caption list-content list-caption list-title-caption">
	        <h5>
	            <a href="{{url($recomended_post->created_at->format('Y').'/'.$recomended_post->created_at->format('m').'/'.$recomended_post->post_slug.'.html')}}">
	                {{$recomended_post->post_title}}
	            </a>
	        </h5>
	        @foreach($recomended_post->taxonomies as $category)
		        <h6>
		            <a href="{{url($category->taxonomy.'/'.$category->full_slug)}}">
		                <img src="{{module_asset_url('appearance:assets/icon/love.png')}}" alt="love icon">
		                Kategory {{$category->term->name}}
		            </a>
		        </h6>
	        @endforeach
	    </div>
	</div>
@endforeach