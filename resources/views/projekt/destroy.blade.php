@extends('welcome')
@section('content')
<div class="section">
<div class="box">
<h3 class="title">Smazání projektu</h3>
<table>
	<thead>
		<tr>
			<th>Název projektu</th>
			<th>Smazat</th>

		</tr>
	</thead>
	<tbody>

		@foreach ($projects as $project)
		<tr>
		    <td>{{$project->nazev}}</td><td><a href = "\smazat_projekt\{{$project->idproj}}" class="button is-danger is-outlined"> <i class="fas fa-ban"></i></a></td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>
</div>
@endsection