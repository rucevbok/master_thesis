@extends('welcome')
@section('content')

<div class="section">
	<div class="box"> 
	@if(strcmp(Auth::user()->role,'user')==0)
		<h3 class="title">Zvolte projekt</h3>
	@else
		<h3 class="title">Zvolte projekt pro úpravu</h3>
	@endif
		<div class="columns">
			<div class="column is-one-fifth">
				<h6 class="title">Projekt</h6>

				@foreach ($swotky as $project)
					<li> <a href="\swot_uprava\{{$project->idproj}}">{{$project->nazev}}</a></li>
				@endforeach



			</div>
			
			<div class="column auto">
				<h6 class="title">SWOT analýza</h6>
				<div class="box">
				<p><b>projekt:</b> <i>{{$popis_projektu->nazev}}</i></p>
				<p><b>popis projektu:</b> {{$popis_projektu->popis}}</p>
			</div>
				<form method="POST" action="/swot_uprava/{{$idpr}}/save">
					{{csrf_field()}}
					<div class="field is-horizontal">
							<div class="field-label is-normal">
	    						<label class="label">S:</label>
	  						</div>	
	  					<div class="field-body">
							<textarea class="textarea" name="strengths" placeholder=""
							@if(strcmp(Auth::user()->role,'user')==0)
							readonly
							@endif
							>{{$swot->strengths}}
							</textarea>
						</div>
					</div>

					<div class="field is-horizontal">
							<div class="field-label is-normal">
	    						<label class="label">W:</label>
	  						</div>	
	  					<div class="field-body">
							<textarea class="textarea" name="weak" placeholder=""
							@if(strcmp(Auth::user()->role,'user')==0)
							readonly
							@endif
							>{{$swot->weak}}
							</textarea>
						</div>
					</div>

					<div class="field is-horizontal">
							<div class="field-label is-normal">
	    						<label class="label">O:</label>
	  						</div>	
	  					<div class="field-body">
							<textarea class="textarea" name="opport" placeholder=""
							@if(strcmp(Auth::user()->role,'user')==0)
							readonly
							@endif
							>{{$swot->opport}}
							</textarea>
						</div>
					</div>

					<div class="field is-horizontal">
							<div class="field-label is-normal">
	    						<label class="label">T:</label>
	  						</div>	
	  					<div class="field-body">
							<textarea class="textarea" name="threats" placeholder=""
							@if(strcmp(Auth::user()->role,'user')==0)
							readonly
							@endif
							>{{$swot->threats}}
							</textarea>
						</div>
					</div>
					@if(strcmp(Auth::user()->role,'user')!==0)
					<button class="button is-info" type="submit">Upravit</button>
					@endif
					
				</form>	
			</div>
			<?php $edit_flag = Session::get('edit_flag'); ?>
			@if ($edit_flag==1)
				<div class="column is-one-third ">

					<p class="notification is-info">Upraveno</p>
				</div>
			@else

			@endif
		</div>
	</div>	
</div>
@endsection