@extends('welcome')
@section('content')
<div class="section">
<div class="box">
     <h3 class="title">Checklisty</h3>
<div class="columns">

  <div class="column is-one-third">
    <h6 class="title">Zvolte projekt</h6>

    @foreach($moje_projekty as $project)
    <li> <a href="/checklist/{{$project->idproj}}">{{$project->nazev}}</a> </li>
    @endforeach

  </div>

  <div class="column auto">
    <h6 class="title">Kontrolní seznam projektu</h6>
    <p>pro zobrazení kontrolního seznamu zvolte projekt</p>

  </div>

</div>
</div>
</div>

@endsection


