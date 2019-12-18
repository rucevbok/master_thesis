@extends('welcome')
@section('content')
<div class="section">
	<div class="box">

	    <h3>Stávající checklist</h3>
	    <table class="table is-hoverable">
			<thead>
				<th>Název oblasti</th>
				<th>Otázka</th>

			</thead>
			<tbody>
	    @foreach($vsechny_otazky as $proj)
			<tr>
				@if($old_oblast!=$proj->id_oblasti)
					<td ><i>{{$proj->nazev_oblasti}}</i></td>
					<td>{{$proj->otazka}}</td>	
				@else
					<td></td>
					<td>{{$proj->otazka}}</td>
				@endif
			</tr>
			@php
				$old_oblast = $proj->id_oblasti;
			@endphp
				
		
	    @endforeach
	    </tbody>
	    </table>
	    <h3>Vložení nové otázky</h3>
	<table class="table is-fullwidth">
		<tr>
	    	<td>
		    	<form action="/cl_pridat">
			    	
					  
					</div>
		    	</form>
		    </td>
		</tr>
	

	</table>
				<form method="post" action="/cl_pridat">
				{{csrf_field()}}
				<div class="field is-horizontal">
				  <div class="field-label is-normal">
				    <label class="label">Oblast:</label>
				  </div>
				  <div class="field-body select">
				    <div class="field">
				      <p class="control">
				      <select name="oblast">
						  	@foreach($oblasti as $obl)
						    	<option value="{{$obl->id_oblasti}}">{{$obl->nazev_oblasti}}</option>
						    @endforeach
					  	</select>
				      </p>
				    </div>
				  </div>
				</div>



	    		<div class="field is-horizontal">
				  <div class="field-label is-normal">
				    <label class="label">Otázka:</label>
				  </div>
				  <div class="field-body">
				    <div class="field">
				      <p class="control">
				        <input class="input" type="text" name="otazka" placeholder="Text otázky">
				      </p>
				    </div>
				  </div>
				</div>

            	<input class="button is-info" type="submit" name="" value="Potvrdit výběr">
			</form>
	    	
</div>
	</div>
</div>
@endsection



















