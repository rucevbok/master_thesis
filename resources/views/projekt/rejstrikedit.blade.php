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


<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
  </div>
  <div class="is-divider-vertical" data-content="OR"></div>
  <div class="column is-one-fifth">
    <h3 class="subtitle">Výpis rizik:</h3>
    <p class="has-text-grey-light">Zvolte projekt</p>
  </div>
  <div class="is-divider-vertical"></div>
  <div class="column auto">
    <h3 class="subtitle">Podrobnosti o riziku:</h3>
    <p class="has-text-grey-light">Zvolte riziko</p> 
  </div>
</div>
</div>
</div>
@endsection


