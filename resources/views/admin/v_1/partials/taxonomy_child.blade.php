@foreach (Route::current()->getController()->getChild($taxonomy)->taxonomyChildrens as $taxonomy)
    <option data-term-id="{{$taxonomy->term_id}}" data-parent-id="{{$taxonomy->parent_id}}" value="{{$taxonomy->term->name}}">{{$taxonomy->term->name}}  -- Sub Taxonomy Of {{$taxonomy->parent->name}}</option>
    @if(Route::current()->getController()->getChild($taxonomy)->taxonomyChildrens->count() > 0)
        @include('appearance::admin.'.$theme_cms->value.'.partials.taxonomy_child', ['taxonomy' => $taxonomy])
    @endif
@endforeach