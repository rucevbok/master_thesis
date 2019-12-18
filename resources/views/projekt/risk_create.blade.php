@extends('welcome')
@section('content')
<div class="section">
	<div class="box">
<h3 class="title">Vytvoření nového rizika</h3>
<h6 class="sub-title">Název projektu: {{$nazev_projektu->nazev}}</h6>
	<form method="POST" action="/rejstrik/{{$nazev_projektu->idproj}}/save_risk">
		{{csrf_field()}}
		{{method_field('PATCH')}}

		
		<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Název rizika</label>
					</div>	
				<div class="field-body">
				 <input class="input" type="text" name="nazev" placeholder="Název rizika" required>
			</div>
		</div>
		@foreach($sablona as $polozka_sablony)
		<div>
			@if(strcmp($polozka_sablony->atribut,'Dopad')==0)
				<div class="field is-horizontal">
					<div class="field-label is-normal">
		    						<label class="label">{{$polozka_sablony->atribut}}</label>
		  						</div>	
		  			<div class="field-body">
					<select name="{{$polozka_sablony->atribut}}">
	 					<option value="1">1</option>
	 					<option value="2">2</option>
	 					<option value="3" selected='selected'>3</option>
	 					<option value="4">4</option>
	 					<option value="5">5</option>
	 				</select>
	 			</div>
	 			</div>
			
			@elseif(strcmp($polozka_sablony->atribut,'Pravděpodobnost')==0)
				<div class="field is-horizontal">
					<div class="field-label is-normal">
		    						<label class="label">{{$polozka_sablony->atribut}}</label>
		  						</div>	
		  			<div class="field-body">
					<select name="{{$polozka_sablony->atribut}}">
	 					<option value="1">1</option>
	 					<option value="2">2</option>
	 					<option value="3" selected='selected'>3</option>
	 					<option value="4">4</option>
	 					<option value="5">5</option>
	 				</select>
	 			</div>
	 			</div>
	 		
	 		@elseif(strcmp($polozka_sablony->atribut,'Risk owner')==0)
				<div class="field is-horizontal">
					<div class="field-label is-normal">
		    						<label class="label">{{$polozka_sablony->atribut}}</label>
		  						</div>	
		  			<div class="field-body">
					<select name="Risk owner">
	 					@foreach ($clenove_projektu as $clen)
	 						<option value="{{$clen->login}}">{{$clen->login}}</option>
	 					@endforeach
	 				</select>
	 			</div>
	 			</div>	
			
			@else
				<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">{{$polozka_sablony->atribut}}</label>
					</div>	
				<div class="field-body">
				 <input class="input" type="text" name="{{$polozka_sablony->atribut}}" placeholder="{{$polozka_sablony->atribut}}" required>
			</div>
		</div>
			@endif
		</div>
		@endforeach	
		
		<div>
			<button class="button is-info" type="submit">Vytvořit riziko</button>
		</div>

		@if ($errors -> any())
		<div class = "notification is-danger">
			<ul>	
				@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</form>
</div>
</div>
@endsection