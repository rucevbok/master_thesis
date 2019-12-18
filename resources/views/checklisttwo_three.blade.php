@extends('welcome')
@section('content')
<div class="section">
<div class="box">
<div class="box">
<h1>Vytvoření nového obsahu</h1>
	    <h6>Stávající checklist</h6>
	    <table class="table">
			<thead>
				<th>Název oblasti</th>
				<th>Otázka</th>

			</thead>
			<tbody>
	    @foreach($projekty_s_checklistem as $proj)
			<tr>
				@if($old_oblast!=$proj->id_oblasti)
					<td><i>{{$proj->nazev_oblasti}}</i></td>
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
	</div>
	</tbody>
</table>
</div>
<div>
<div class="box">
 <h6>Zvolte otázky, které chcete vložit</h6>
 <table class="table">
 	<thead>
				<th>Název oblasti</th>
				<th>Otázka</th>
				<th>Přidat</th>
	</thead>

	@php
		$old_oblast = "?#@*L";
	@endphp
	<form method="post" action="/checklisttwo/{{$projekty_s_checklistem->first()->idproj}}/store">
        		{{csrf_field()}}
 		@foreach($vsechny_otazky as $check)
			<tr>
				@if($old_oblast!=$check->id_oblasti)
					<td><i>{{$check->nazev_oblasti}}</i></td>
					<td>{{$check->otazka}}</td>	
					<td>
					
                		
                  			<label class="containerr">
                    		<input class="checkbox" type="checkbox" name="pridat[]" value="{{$check->poradi}}*{{$check->id_oblasti}}" >
              				<span class="checkmark"></span>
                  				</label>
               		
              		
              	</td>
				@else
					<td></td>
					<td>{{$check->otazka}}</td>
					<td>
					
		                
		                  	<label class="containerr">
		                    <input class="checkbox" type="checkbox" name="pridat[]" value="{{$check->poradi}}*{{$check->id_oblasti}}" >
		              		<span class="checkmark"></span>
                  </label>
		                
              		
              	</td>
				@endif
			</tr>
			@php
				$old_oblast = $check->id_oblasti;
			@endphp
	    @endforeach
	    <tr>
	    	<td>
	    		<input type="hidden" name="idproj" value="{{$id_proj}}" >
            	<input class="button is-info" type="submit" name="" value="Potvrdit výběr">
        	</td>
	    </tr>
	</form>
</table>
</div>
</div>
</div>
</div>
@endsection



















