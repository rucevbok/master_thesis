@extends('welcome')
@section('content')
<div class="section">
<div class="box">
<h1 class="title">Úprava rejstříku rizik projektu </span></h1>
<form method="POST" action="/rejstrik">
      {{csrf_field()}}
  <div class="columns">
    <div class="column is-one-fifth">
      <h3>Vyberte projekt:</h3>
      @foreach ($nazvy_projektu as $project)
      <li> <a href="\rejstrik\{{$project->idproj}}">{{$project->nazev}}</a></li>
      @endforeach

</form>
</div>
  <div class="is-divider-vertical" data-content="OR"></div>
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
    <h3>Podrobnosti rizika č.{{$podrobnosti_riziko->first()->cislor}}</h3>

    <form method="POST" action="\rejstrik\{{$podrobnosti_riziko->first()->idproj}}\{{$podrobnosti_riziko->first()->cislor}}\store">
      {{csrf_field()}}
      {{method_field('PATCH')}}
      @foreach ($podrobnosti_riziko as $podrobnosti)
        @if (strcmp($podrobnosti->atribut,'Risk owner')==0)
        <label class="label" for="{{$podrobnosti->atribut}}">{{$podrobnosti->atribut}}</label>
        <div class="select">
        <select name="Risk owner">
          @foreach($clenove_projektu as $clen)
            <option value="{{$clen->login}}"
              @if(strcmp($podrobnosti->hodnota,$clen->login)==0)
                selected 
              @endif
              >{{$clen->login}}</option>
          @endforeach
          </select>
        </div>
        @elseif(strcmp($podrobnosti->atribut,'Pravděpodobnost')==0)
          <label class="label" for="{{$podrobnosti->atribut}}">{{$podrobnosti->atribut}}</label>
          <div class="select">
          <select name="Pravděpodobnost">
              <option value="1"
              @if(strcmp($pst_val, '1')==0)
                selected
              @endif 
              >1</option>
              <option value="2"
              @if(strcmp($pst_val, '2')==0)
                selected
              @endif 
              >2</option>
              <option value="3"
              @if(strcmp($pst_val, '3')==0)
                selected
              @endif 
              >3</option>
              <option value="4"
              @if(strcmp($pst_val, '4')==0)
                selected
              @endif 
              >4</option>
              <option value="5"
              @if(strcmp($pst_val, '5')==0)
                selected
              @endif 
              >5</option>
            </select>
          </div>
        @elseif(strcmp($podrobnosti->atribut,'Dopad')==0)
          <label class="label" for="{{$podrobnosti->atribut}}">{{$podrobnosti->atribut}}</label>
          <div class="select">
          <select name="Dopad">
              <option value="1"
              @if(strcmp($dopad_val, '1')==0)
                selected
              @endif 
              >1</option>
              <option value="2"
              @if(strcmp($dopad_val, '2')==0)
                selected
              @endif 
              >2</option>
              <option value="3"
              @if(strcmp($dopad_val, '3')==0)
                selected
              @endif 
              >3</option>
              <option value="4"
              @if(strcmp($dopad_val, '4')==0)
                selected
              @endif 
              >4</option>
              <option value="5"
              @if(strcmp($dopad_val, '5')==0)
                selected
              @endif 
              >5</option>
            </select>
          </div>
        
        @else

        <div class="field is-vertical">
          <label class="label" for="{{$podrobnosti->atribut}}">{{$podrobnosti->atribut}}</label>
            <div class="control is-vertical">
              <input type="hidden" name="{{$podrobnosti->atribut}}" value="{{$podrobnosti->atribut}}">
              <input type="text" class="input" name="{{$podrobnosti->atribut}}" placeholder="{{$podrobnosti->hodnota}}" value="{{$podrobnosti->hodnota}}">
            </div>

        </div>
        @endif
      @endforeach
      <div class="field">
          <div class="control">
            <button type="submit" class="button is-link">Upravit</button>
          </div>
        </div>
    </form>
    <div>

    </div>
    @if ($success)
    <div class = "notification is-success">
      <p>Uloženo</p>     
    </div>
    @endif

  </div>
</div>
</div>
</div>
@endsection


