<?php $nav_pr = 'is-active'; ?>
@extends('welcome')
@section('content')
<head>

</head>

<div class="section">
<div class="box"> 
	<h3 class="title">Přehled projektů</h3>
<table class="table">
	<thead>
		<tr>
			<th>Smazat projekt</th>
			<th>Název projektu</th>
			<th>Proj. manažer</th>
			<th>Členové</th>
			<th style="text-align: center">Odebrat člena</th>
		</tr>
	</thead>
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>

@foreach($uz as $zaznam)

		{{csrf_field()}}
		{{method_field('PATCH')}}
	<tr>
		@if(strcmp($zaznam->idproj,$stara)!==0)
			<th>
				<a  href="/smazat_projekt/{{$zaznam->idproj}}"  onclick="return confirm('Opravdu chcete smazat projekt?')" class="button is-danger is-outlined" name="lol" value= "{{$zaznam->idproj}}"type="submit"><span class="icon is-small">
      			<i class="fas fa-times"></i>
    			</span></i></a>
			</th>
			<th><abbr title="{{$zaznam->popis}}">{{$zaznam->nazev}}</th>
			<td>{{$zaznam->name}}</td>
		@endif
		@if(strcmp($zaznam->idproj,$stara)==0)
		    <td></td>
			<td></td>
			<td></td>
		@endif
		
		<td>{{$zaznam->name}}</td>
		@php
			$stara=$zaznam->idproj
		@endphp
		

	<td style="text-align: center">
		<a href="/odebrat_clena/{{$zaznam->idproj}}/{{$zaznam->email}}" onclick="return confirm('Opravdu chcete smazat uživatele?')" class="button is-danger is-outlined" name="lol" value= "{{$zaznam->email}}" >
		<span class="control">
		
			<span class="icon is-small">
      <i class="fas fa-times"></i>
    </span></i></a>
			
		</span>
	</td></tr>

@endforeach
	</table>
</div>

	<div class="box"> 
		<h3 class="title">Vytvořit nový</h3>
		
	  		
			<form method="POST" action="/pridat_projekt">
							{{csrf_field()}}
							{{method_field('PATCH')}}
	  		
	  		<div class="field">
	  					<label class="label">Název projektu</label>
	  					<div class="control">
	    					<input class="input" type="text" name="nazev" placeholder="Název projektu" required>
	  					</div>
			</div>

			<div class="field">
	  					<label class="label">Popis projektu</label>
	  					<div class="control">
	    					<input class="input" type="text" name="popis" placeholder="Název projektu" required>
	  					</div>
			</div>

			<div class="field">
				<label class="label">Projektový manažer</label>
				  <p class="control has-icons-left">
				    <span class="select">
				      <select name="role" >

				        @foreach($projektaci as $projektak)
							<option value="{{$projektak->email}}">{{$projektak->name}}</option>
						@endforeach
				      </select>
				    </span>
				    <span class="icon is-small is-left">
				      <i class="fas fa-user"></i>
				    </span>
				  </p>
			</div>

			<div class="field">
				<label class="label">Řešitelský tým</label>	   
				<table class="table">
						
				        @forelse($vsichni_users as $us)
				        <tr>
							<td>{{$us->name}}</td>
							<td>
								<label class="containerr">
									<input type="checkbox" name="clenove[]" value="{{$us->email}} ">
							<span class="checkmark"></span>
							</label>
						</td>
						</tr>
						@empty
							<p>Vložte uživatele</p>
						@endforelse
				</table>
			</div>
			
			<div class="field">
				<label class="label">Šablona rejstříku rizik</label>
				<table class="table">
						@forelse($katalog as $polozka_katalogu)
						<tr>
							<td>{{$polozka_katalogu->atribut}}</td>
							<td>
								<label class="containerr">
								<input type="checkbox" name="result[]" value="{{$polozka_katalogu->atribut}}"
							@if(strcmp($polozka_katalogu->atribut, 'Dopad')===0)
								checked="true"  required="true" 
							@elseif(strcmp($polozka_katalogu->atribut, 'Pravděpodobnost')===0)
								checked="true" required="true" 
							@endif
							>
						<span class="checkmark"></span>
						</label></td>
						</tr>
						@empty
    						<p>Vložte položky do katalogu</p>
						@endforelse
				</table>
			</div>
			
			<div class="control">
						<button class="button is-primary" type="submit" 
						@if($katalog->isEmpty())
							disabled
						@endif 
						>Přidat</button>
						<button class="button is-text" type="reset">Resetovat</button>
			</div>
		
		</form>
	</div>
	



	</div>
</div>

@endsection














