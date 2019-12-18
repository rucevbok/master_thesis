<?php $nav_uz = 'is-active'; ?>
@extends('welcome')
@section('content')
<div class="section">

<div class="box">
<h3 class="title">Správa uživatelů</h1>



	<table class="table">
	<thead>
		<tr>
			<th><abbr title="jmeno">Jméno</abbr></th>
			<th><abbr title="email">E-mail</abbr></th>
			<th><abbr title="role">Role</abbr></th>
			<th style="text-align: center"><abbr title="smazat">Smazat</abbr></th>
		</tr>
	</thead>
	<tbody>
	@foreach ($uzivatele as $uzivatel)
		<form class="deledte" method="POST" action="/smazat">
		{{csrf_field()}}
		{{method_field('PATCH')}}
		<tr>
			<th>{{$uzivatel->name}}</th>
			<td>{{$uzivatel->email}}</td>
			<td>{{$uzivatel->role}}</td>
			<td style="text-align: center">
				<input  type="hidden" name="smazanej" value="{{$uzivatel->email}}"placeholder="Jméno">
				<button onclick="return confirm('Opravdu chcete smazat uživatele?')" class="button is-danger is-outlined" type="submit">	<span class="icon is-small">
      <i class="fas fa-times"></i>
    </span></i></button>
				
			</td>
		</tr>
		</form>
	@endforeach 

	</tbody>
</table>
</div>
<div class="box"> 
	<h3 class="subtitle"> Vytvoření nového účtu</h3>
	<form method="POST" action="/uloz_uzivatele">
		{{csrf_field()}}
		{{method_field('PATCH')}}	
		
				<div class="field">
  					<label class="label">Jméno</label>
  					<div class="control">
    					<input class="input" type="text" name="nazev" placeholder="Jméno">
  					</div>
				</div>
			
				
				<div class="field">
  					<label class="label">E-mail</label>
					<div class="control has-icons-left has-icons-right">
	    				<input class="input" type="email" name="email"  placeholder="Email input" value="@">
	   					<span class="icon is-small is-left">
	      					<i class="fas fa-envelope"></i>
	    				</span>
	    				<span class="icon is-small is-right">
	      					
	   					</span>
  					</div>
  					
				</div>
				

				
			<div class="field">
				<label class="label">Heslo</label>
			  		<p class="control has-icons-left">
			    	<input class="input"  name="heslo"  type="password" placeholder="Password" required>
			    	<span class="icon is-small is-left">
			      		<i class="fas fa-lock"></i>
			    	</span>
			  </p>
			</div>
	
			<div class="field">
				<label class="label">Role</label>
			  <p class="control has-icons-left">
			    <span class="select">
			      <select name="role" >
			        <option selected>user</option>
			        <option>admin</option>
			        <option>projmanazer</option>
			      </select>
			    </span>
			    <span class="icon is-small is-left">
			      <i class="fas fa-user"></i>
			    </span>
			  </p>
			</div>

		
			
				<div class="control">
					<button class="button is-info" type="submit">Vytvořit</button>
					<button class="button is-text" type="reset">Resetovat</button>
				</div>
		
			
			


	</form>

</div>
</div>

@endsection