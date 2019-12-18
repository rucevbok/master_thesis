@extends('welcome')
@section('content')
<h1 class="title">Vytvoření nového projektu</h1>
	<form method="POST" action="/projekt">
		{{csrf_field()}}
		{{method_field('PATCH')}}
		<div>
			Název: <input type="text" name="nazev" placeholder="Název" required>
			
		</div>
		<div>
			Popis:  <input type="text" name="popis" placeholder="Popis" required>
		</div>


			@foreach ($katalog as $polozka_katalogu)
			<div>
				<label class="containerr">
				<input type="checkbox" name="result[]" value="{{$polozka_katalogu->atribut}}">{{$polozka_katalogu->atribut}}
				<span class="checkmark"></span>
</label>
			</div>
			@endforeach
		
		<div>
			<button type="submit">Vytvoř projekt</button>
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
@endsection