@extends('welcome')
@section('content')
<div class="section">
<div class="box">
<h3 class="title">Zvolte projekt pro úpravu</h3>

    <div class="columns">

    	<div class="column is-one-fifth">
    		<h6 class="title">Projekt</h6>
		    @foreach($projekty_uzivatele as $project)
		    <li> <a href="/checklisttwo/{{$project->idproj}}">{{$project->nazev}}</a> </li>
		    @endforeach
		</div>

	<div class="column auto">
		<h6 class="title">Kontrolní seznam</h6>
		<p class="has-text-grey-light">Zvolte projekt</p>
	</div>
	</div>
</div>


@endsection



















