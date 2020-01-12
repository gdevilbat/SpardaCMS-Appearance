@foreach (Route::current()->getController()->getChild($taxonomy)->childrens as $taxonomy)
    <option data-id="{{$taxonomy->getKey()}}" data-taxonomy-parent-id="{{$taxonomy->getKey()}}" data-term-id="{{$taxonomy->term_id}}" data-parent-id="{{$taxonomy->parent_id}}" value="{{$taxonomy->term->name}}">{{$taxonomy->term->name}}  -- Sub Taxonomy Of {{$taxonomy->parent->term->name}}</option>
    @if(Route::current()->getController()->getChild($taxonomy)->childrens->count() > 0)
        @include('appearance::admin.'.$theme_cms->value.'.partials.taxonomy_child', ['taxonomy' => $taxonomy])
    @endif
@endforeach