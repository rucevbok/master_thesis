@extends('welcome')
@section('content')
<div class="section">
	<div class="box"> 
		<h3 class="title">Katalog atributů rejstříku rizik</h3>
		@if(!$katalog->isEmpty())
		<table>
			<thead>
				<th>Název</th>
				<th>Popis</th>
				<th style="text-align: center">Smazat</th>
				
			</thead>
			<tbody>
				
				@forelse($katalog as $item)
				<form method="POST" action="/katalog_smazat">
					{{csrf_field()}}
				<tr>
				    <td>{{ $item->atribut }}</td>
				    <td>{{ $item->popis }}</td>
				    <td style="text-align: center">
				<input  type="hidden" name="smazanej" value="{{$item->atribut}}"placeholder="Jméno">
				<button class="button is-danger is-outlined" type="submit">	<span class="icon is-small">
      <i class="fas fa-times"></i>
    </span></i></button>
				
			</td>
				</tr>
				</form>
				@empty
				    <p>Prázdný</p>
				@endforelse
			
			</tbody>
		</table>

		@else
		    <p>Prázdný</p>
		@endif
		@if (session('alert'))
   <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
@endif
		<hr style="border: 1px solid gray;">
		<form method="post" action="\katalog\vloz">	
			{{csrf_field()}}
			{{method_field('PATCH')}}
			<div class="field">
	  					<label class="label">Atribut</label>
	  					<div class="control">
	    					<input class="input" type="text" name="atribut" placeholder="Atribut" required>
	  					</div>
			</div>
			<div class="field">
	  					<label class="label">Popis</label>
	  					<div class="control">
	    					<input class="input" type="text" name="popis" placeholder="Popis" required>
	  					</div>
			</div>
			<button class="button is-info" type="submit">Přidat</button>
		</form>
		<hr style="border: 1px solid gray;">
		<form method="post" action="\katalog\vlozdo_projektuP">
			
		{{csrf_field()}}	
		<div class="columns">
			<div class="column is-one-third">
			<div class="field">
	  					<label class="label">Projekt</label>
	  					<p class="control has-icons-left">
			    <span class="select">
			      <select name="projekt" >
			      	@foreach($projects as $proj)

			       		<option value="{{$proj->idproj}}" 
			       			@if($pro == $proj->idproj)
			       				selected
			       			@endif 
			       			>{{$proj->nazev}}</option>
			        @endforeach
			      </select>
			    </span>
			    <span class="icon is-small is-left">
			      <i class="fas fa-user"></i>
			    </span>
			  </p>
			</div>
			<button class="button is-info"  type="submit">Zvolit projekt</button>
			</form>
		<form method="post" action="\katalog\vlozdo_projektuA">
			<input type="hidden" name="idproj" value="{{$pro}}">
				{{csrf_field()}}
		</div>
		<div class="column is-one-third">
			<div class="field">
				<label class="label">Atribut</label>
			  <p class="control has-icons-left">
			    <span class="select">
			      <select name="role" >
			      	@foreach($rozdil as $ro)
			      		<option value="{{$ro}}" selected>{{$ro}}</option>
			      	@endforeach
			      </select>
			    </span>
			    <span class="icon is-small is-left">
			      <i class="fas fa-user"></i>
			    </span>
			  </p>
			</div>
			<button class="button is-info"  type="submit">Přidat atribut</button>
		</div>
			
		</form>
	</div>
	
	</div>
</div>
@endsection














