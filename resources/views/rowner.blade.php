@extends('welcome')
@section('content')
<div class="section">
<div class="box">
<h3 class="title">Moje rizika: </span></h3>
<div class="columns">
	<div class="column is-one-fifth">
		<table class="table">
			<thead>
				<th>Projekt</th>
				

			</thead>
			<tbody>
				@forelse ($moje_projekty as $proj)
		    		<tr>
		    			<td><a href="/riskowner/{{Auth::user()->email}}/{{$proj->idproj}}">{{$proj->nazev}}</a></td>
		    			
		    		</tr>
				@empty
		    		<p>žádná rizika</p>
				@endforelse
			</tbody>
		</table>
	</div>
	<div class="column is-one-fifth">
		<p>Detail projektu</p>
		<table class="table">
			<thead>
				<th>Číslo rizika</th>
				<th>Název rizika</th>

			</thead>
			<tbody>
				@forelse ($detail_rizik_proj as $riz)
		    		<tr>
		    			<td>{{$riz->cislor}}</td>
		    			<td>{{$riz->nazev_rizika}}</td>
		    			
		    		</tr>
				@empty
		    		<tr><td colspan="2">zvolte projekt</td></tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>
</div>
</div>
@endsection

