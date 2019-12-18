@extends('welcome')
@section('content')

<div class="section">
	<div class="box"> 
	@if(strcmp(Auth::user()->role,'user')==0)
		<h3 class="title">Zvolte projekt</h3>
	@else
		<h3 class="title">Zvolte projekt pro úpravu</h3>
	@endif
	
		<div class="columns">
			<div class="column is-one-fifth">
				<h6 class="title">Projekt</h6>

				@foreach ($swotky as $project)
					<li> <a href="\swot_uprava\{{$project->idproj}}">{{$project->nazev}}</a></li>
				@endforeach

			</div>

			<div class="column is-one-third">
				<h6 class="title">SWOT</h6>
				<p class="has-text-grey-light">Zvolte projekt</p>
			</div>
		</div>
	</div>	
</div>
@endsection