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
		      <select name="clen" >
		        @foreach($clenove as $clen)

					<option value="{{$clen->email}}">{{$clen->name}}</option>
				@endforeach
		      </select>
		</span>
		    {{--
			@foreach($clenove as $clen)
				<input type="hidden" name="clen" value="{{$clen->email}}" >
				<a href="/pridat_clena_save/{{$clen->email}}" value="{{$clen->email}}">{{$clen->name}}<br></a>
			@endforeach
			--}}
	</div>

	<div class="control">
		<button class="button is-info" type="submit">Přidat</button>
	</div>
  </div>

</form>
</div>
</div>
</div>
</div>


@endsection