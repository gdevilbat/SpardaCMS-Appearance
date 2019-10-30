@php
    $posts = $posts_builder->paginate(16);
@endphp

@extends('appearance::general.newsmaker.templates.parent')

@section('title')
    {{!empty($taxonomy->term->name) ? $taxonomy->term->name : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('content')
    <div class="col-md-6 offset-md-2">
        <div class="w-100">
            <div class="heading-bold text-center">
                <h2>Ekonomi</h2>
            </div>
        </div>
        <div class="w-100">
            @foreach ($posts as $post)
                <div class="list">
                    <div class="caption list-content list-caption">
                        <h5>
                            <a href="{{url($post->created_at->format('Y').'/'.$post->created_at->format('m').'/'.$post->post_slug.'.html')}}">
                                {!!$post->post_excerpt!!}
                            </a>
                        </h5>
                        <h6>
                            @php
                                $taxonomies = $post->taxonomies->where('taxonomy', 'category');
                            @endphp
                            @foreach ($taxonomies as $taxonomy)
                                @php
                                    $category = $taxonomy->load('term');
                                @endphp
                                <a href="{{$category->full_slug}}">
                                    <img src="{{module_asset_url('appearance:assets/icon/love.png')}}" alt="love icon">
                                        Kategori {{$category->term->name}}
                                </a>
                            @endforeach
                        </h6>
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
                        <a href="{{url($post->created_at->format('Y').'/'.$post->created_at->format('m').'/'.$post->post_slug.'.html')}}">
                            <img src="https://dummyimage.com/600x200/084494/fff" alt="Judul Berita">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="w-100">
            <div class="row justify-content-center">
                {{ $posts->links('appearance::general.newsmaker.pagination.simple') }}
            </div>
        </div>
    </div>
@endsection