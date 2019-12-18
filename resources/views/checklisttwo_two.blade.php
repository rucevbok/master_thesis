@extends('welcome')
@section('content')
<div class="section">
<div class="box">
<h3 class="title">Zvolte projekt pro úpravu</h3>
<div class="columns">
	<div class="column is-one-fifth">
		<h6 class="title">Projekt</h6>

	    @foreach($projekty_uzivatele as $project)
	    <li> <a href="/checklisttwo/{{$project->idproj}}">{{$project->nazev}}</a> </li>
	    @endforeach
	</div>
	<div class="column auto">
		<h6>Kontrolní seznam projektu <span class="has-text-info">{{$proj->nazev}}</span></h6>
		<table class="table">
			<thead>
				<th>Název oblasti</th>
				<th>Otázka</th>
				<th>Komentář</th>
				<th>Splněno</th>
			</thead>
			<tbody>
			<form method="post" action="/checklisttwo/{{$projekty_s_checklistem->first()->idproj}}/uprav">
        		{{csrf_field()}}
			@foreach($projekty_s_checklistem as $proj)
			<tr>
				@if($old_oblast!=$proj->id_oblasti)
					<td><i><b>{{$proj->nazev_oblasti}}</b></i></td>
					<td>{{$proj->otazka}}</td>	
					<td>
		              <div class="field">
		                <div class="control">
		                  
		                    <input class="textarea"  type="textarea" name="{{$proj->poradi}}*{{$proj->id_oblasti}}*komentar" value="{{$proj->komentar}}">
		               
		                </div>
		              </div>
            		</td>
					<td>
		              <div class="field">
		                <div class="control">
		                  <label class="containerr">
		                    <input class="checkbox" type="checkbox" name="splneno[]" value="{{$proj->poradi}}*{{$proj->id_oblasti}}" @if($proj->splneno==true) checked @endif>
		              <span class="checkmark"></span>
                  </label>
		                </div>
		              </div>
            		</td>

				@else
				<td></td>
				<td>{{$proj->otazka}}</td>
				<td>
		              <div class="field">
		                <div class="control">
		                  
		                    <input class="textarea" type="textarea" name="{{$proj->poradi}}*{{$proj->id_oblasti}}*komentar" value="{{$proj->komentar}}">
		               
		                </div>
		              </div>
            		</td>
				<td>
              <div class="field">
                <div class="control">
                  	<label class="containerr">
                    <input class="checkbox" type="checkbox" name="splneno[]" value="{{$proj->poradi}}*{{$proj->id_oblasti}}" @if($proj->splneno==true) checked @endif>
              <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </td>
				@endif
			</tr>
			@php
				$old_oblast = $proj->id_oblasti;
			@endphp
			@endforeach
		</tbody>
		
		<tr>
        <td>
        	</td>
        	<td>
          <div class="field">
                <div class="control">
                	<input type="hidden" name="idproj" value="{{$id_proj}}" >
                	<input class="button is-info" type="submit" name="" value="Upravit">
                </div>
          </div>
      </form>
  </td>
  <td>
      <form method="post" action="/checklisttwo/{{$projekty_s_checklistem->first()->idproj}}/pridat">
      	{{csrf_field()}}
      		<input type="hidden" name="idproj" value="{{$id_proj}}" >
            <input class="button is-info" type="submit" name="" value="Přidat otázky">
      </form>
      </td>
      </tr>
	</table>
	</div>




</div>



</div>
</div>


@endsection



















