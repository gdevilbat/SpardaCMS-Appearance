@foreach ($navbars as $navbar)
	@if(isset($navbar->children))
		<h6>
            <a class="btn-collapse" data-toggle="collapse" href="#collapseExample-{{$loop->depth}}-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample" title="{{$navbar->title}}">
                {{$navbar->text}}
                <img src="{{module_asset_url('appearance:assets/icon/arrow_down.png')}}" alt="Arrow Down">
            </a>
        </h6>
        <ul class="collapse" id="collapseExample-{{$loop->depth}}-{{$loop->iteration}}">
            @include('appearance::general.classic.partials.navbar_child', ['navbars' => $navbar->children])
        </ul>
	@else
		<li>
            <span>{{$navbar->text}}</span>
            <a href="{{isset($navbar->slug) ? url($navbar->slug) : 'javascript:void(0)'}}" class="url"></a>
        </li>
	@endif
@endforeach