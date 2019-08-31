@extends('appearance::general.classic.templates.parent')

@section('title')
    {{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row py-2">
                <div class="col-12 py-3">
                    @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'feature_image')->first()) && $post->postMeta->where('meta_key', 'feature_image')->first()->meta_value != null)
                        <img src="{{url('public/storage/'.$post->postMeta->where('meta_key', 'feature_image')->first()->meta_value)}}" alt=""> 
                    @endif
                    {!!$post->post_content!!}
                </div>
            </div>
        </div>
    </section>
@endsection