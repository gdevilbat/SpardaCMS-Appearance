 <meta name="description" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : ( !empty($post) && !empty($post->post_content) ? strip_tags($post->post_content) : (!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : 'SpardaCMS for Connecting Business and Technology'))}}" />
    <meta name="keywords" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_keyword')->first()) && $post->postMeta->where('meta_key', 'meta_keyword')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_keyword')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_keyword']) ? $settings->where('name','global')->flatten()[0]->value['meta_keyword'] : config('app.name'))}}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_title')->first()) && $post->postMeta->where('meta_key', 'fb_share_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'fb_share_title')->first()->meta_value : ((!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : "SpardaCMS")}} | {{config('app.name')}}" />
    <meta property="og:description" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_description')->first()) && $post->postMeta->where('meta_key', 'fb_share_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'fb_share_description')->first()->meta_value : (!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : 'SpardaCMS for Connecting Business and Technology')}}" />
    <meta property="og:image" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'fb_share_image')->first()) && $post->postMeta->where('meta_key', 'fb_share_image')->first()->meta_value != null) ? asset($post->postMeta->where('meta_key', 'fb_share_image')->first()->meta_value) : (!empty($post) && !empty($post->postMeta->where('meta_key', 'cover_image')->first()) && $post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null ? generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file']) : '')}}"/>
    <meta property="og:image:alt" content="{{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_description')->first()) && $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_description')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_description']) ? $settings->where('name','global')->flatten()[0]->value['meta_description'] : config('app.name'))}}" />