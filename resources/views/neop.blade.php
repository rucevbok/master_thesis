@extends('welcome')
@section('content')

<div class="section">
<div class="box">
<h3 class="title">Neoprávněný přistup</h3>
<table>
	<thead>
		<th> <abbr title="Číslo projektu">Název projektu</abbr></th>
		<th>Login uživatele</th>
		<th>Popis akce</th>
		<th>Timestamp</th>
	</thead>
	<tbody>
		@forelse($tab as $item)
			<tr>
				<td><abbr title="{{$item->idproj}}">{{$item->nazev}}</abbr></td>
				<td>{{$item->email}}</td>
				<td>{{$item->detaily}}</td>
				<td>{{$item->created_at}}</td>
			</tr>
		@empty
			<tr><td colspan="4">tabulka je prázdná</td></tr>
		@endforelse

	</tbody>
</table>
</div>
</div>

@endsection