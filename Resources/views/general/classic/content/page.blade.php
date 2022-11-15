@extends('appearance::general.classic.templates.parent')

@section('title')
    {{(!empty($post) && !empty($post->postMeta->where('meta_key', 'meta_title')->first()) && $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value != null) ? $post->postMeta->where('meta_key', 'meta_title')->first()->meta_value : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('meta_tag')
    @include('appearance::general.classic.partials.post_meta_tag')
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row py-2">
                <div class="col-12 py-3">
                    @if(!empty($post) && !empty($post->postMeta->where('meta_key', 'cover_image')->first()) && $post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'] != null)
                        <img src="{{generate_storage_url($post->postMeta->where('meta_key', 'cover_image')->first()->meta_value['file'])}}" alt=""> 
                    @endif
                    <article>
	                    {!!$post->post_content!!}
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection