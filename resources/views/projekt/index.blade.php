@extends('welcome')
@section('content')

<div class="section">
	<div class="box"> 
	<h3 class="title">Výběr projektu</h3>
		<div class="columns">
			<div class="column is-one-third">
				<h6 class="title">Proj. manažer</h6>

				@foreach ($proj_vedene as $project)
					<li> <a href="\projekt\{{$project->idproj}}\rejstrik">{{$project->nazev}}</a></li>
				@endforeach


			</div>

			<div class="column is-one-third">
				<h6 class="title">Člen týmu</h6>

				@foreach ($proj_clen as $projecte)
					<li> <a href="\projekt\{{$projecte->idproj}}\rejstrik">{{$projecte->nazev}}</a></li>
				@endforeach


			</div>
		</div>
	</div>	
</div>
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>

@endsection