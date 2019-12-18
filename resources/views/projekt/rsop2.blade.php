@extends('welcome')
@section('content')
<div class="section">
<div class="box">
<h1 class="title">Úprava rejstříku rizik projektu </span></h1>
<form method="POST" action="/rejstrik">
    {{csrf_field()}}
<div class="columns">
  <div class="column is-one-fifth">
    <h3 class="subtitle">Vyberte projekt:</h3>
    @foreach ($nazvy_projektu as $project)
    <li> <a href="\rejstrik\{{$project->idproj}}">{{$project->nazev}}</a></li>
    @endforeach

  </form>
</div>

  <div class="column is-one-third">

    <h3 class="subtitle">Výpis rizik:</h3>
    <ol>
    @if($rizika_projektu->count() > 0)
    <table>
      <thead>
        <th>Číslo</th>
        <th>Název</th>
      </thead>
      @foreach ($rizika_projektu as $riziko)
      <tr>
      <td> <a href="\rejstrik\{{$riziko->idproj}}\{{$riziko->cislor}}">{{$riziko->cislor}}</a></td>
      <td><a href="\rejstrik\{{$riziko->idproj}}\{{$riziko->cislor}}">{{$riziko->nazev_rizika}}</a></a></td>
      </tr>
      @endforeach
    </table>
    @else
        <p>žádná rizika</p>
    @endif
      </ol>
    <h6 class="has-text-link"><a href="\rejstrik\{{$id_proj}}\create_risk">Vytvořit nové</a> </h6>
  </div>
  <div class="is-divider-vertical" data-content="OR"></div>
  <div class="column auto">
    <h3 class="subtitle">Podrobnosti o riziku:</h3>
     <p class="has-text-grey-light">Zvolte riziko</p> 
  </div>
</div>
</div>
</div>
@endsection


