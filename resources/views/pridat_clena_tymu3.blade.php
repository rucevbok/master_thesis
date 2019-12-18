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
	    <span class="select">
		      <select name="clen" >
		        @foreach($clenove as $clen)
					<option value="{{$clen->email}}">{{$clen->name}}</option>
				@endforeach
		      </select>
		</span>
	</div>

	<div class="control">
		<button class="button is-info" type="submit">Přidat</button>
	</div>
</form>
</div>
<div class="column is-one-third">
<form method="POST" action="/pridat_clena_save_2">
	{{csrf_field()}}
	<div class="field">
		<label class="label">Přidat uživatele {{$clen_sel}} do projektu:</label>
		  <p class="control has-icons-left">
		    <span class="select">
		      <select name="projekt" >
		        @foreach($vysledek_projekty as $projekt)

					<option value="{{$projekt->idproj}}">{{$projekt->nazev}}</option>

				@endforeach
		      </select>
		    </span>
		    <input type="hidden" name="id_clena" value="{{$clen_sel}}">

		  </p>
	</div>
	<div class="control">
		<button class="button is-info" type="submit" disabled>Přidat</button>
	</div>

</div>
</form>

<div class="column is-one-third">

<div class="hero is-info notification is-primary">
	<p>Úspěšně vloženo</p>
</div>
</div>


</div>
</div>
</div>


@endsection