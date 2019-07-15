@extends('appearance::general.'.$theme_public->value.'.templates.parent')

@section('content')
    <section>
        <div class="container">
            <div class="d-flex align-item-center justify-content-center">
                <img src="{{ asset(!empty($settings->where('name','global')->flatten()->first()->value['not_found_image']) ? $settings->where('name','global')->flatten()->first()->value['not_found_image'] : config('app.name')) }}" style="max-width: 100%;height: auto !important" alt="">
            </div>
        </div>
    </section>
@endsection