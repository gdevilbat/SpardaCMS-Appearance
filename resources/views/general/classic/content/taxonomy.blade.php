@php
    $posts_paginate = $posts_builder->paginate(12);
    $group_posts = $posts_paginate->chunk(4)
@endphp

@extends('appearance::general.classic.templates.parent')

@section('title')
    {{!empty($taxonomy->term->name) ? $taxonomy->term->name : (!empty($settings->where('name','global')->flatten()[0]->value['meta_title']) ? $settings->where('name','global')->flatten()[0]->value['meta_title'] : 'SpardaCMS')}}
@endsection

@section('content')
    
@endsection