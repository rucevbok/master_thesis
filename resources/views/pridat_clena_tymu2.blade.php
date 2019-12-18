@extends('welcome')
@section('content')
<div class="section">
<div class="box"> 
<h3>Přidat člena do týmu</h3>
<div class="columns">
<div class="column is-one-third">
<form method="POST" action="/pridat_clena_save">
	{{csrf_field()}}
		<div class="field">
		<label class="label">Vyberte člena:</label>
	    <span class="select is-info">
		      <select name="clen">
		      	<option style="background-color: green;"> jméno</option>
		        @foreach($clenove as $clen)
					<option value="{{$clen->email}}" selected>{{$clen->name}}</option>
				@endforeach
		      </select>
		</span>
	</div>

	<div class="control">
		<button class="button is-info" type="submit">Aktualizovat</button>
	</div>
</form>
</div>
<div class="column is-one-third">
<form method="POST" action="/pridat_clena_save_2">
	{{csrf_field()}}
	<div class="field">
		<label class="label">Přidat uživatele <span class="has-text-info">{{$clen_name}} </span>do projektu:</label>
		  
		    <span class="select is-info">
		      <select name="projekt" >
		        @foreach($vysledek_projekty as $projekt)

					<option value="{{$projekt->idproj}}">{{$projekt->nazev}}</option>

				@endforeach
		      </select>
		    </span>
		    <input type="hidden" name="id_clena" value="{{$clen_sel}}">

		  
	</div>
	<div class="control">
		<button class="button is-info" type="submit">Přidat</button>
	</div>

</div>
</form>
</div>
</div>
</div>


@endsection