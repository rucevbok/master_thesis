@extends('welcome')
@section('content')
<div class="notification">
  <div class="section">
    <div class="box">
       <div class="section">
        <h1 class="title">Detail projektu <span class="has-text-info">{{$nazev_proj}}</span> <a href="/smazat_projekt/{{$detaily_projektu->idproj}}" onclick="return confirm('Opravdu chcete smazat projekt?')" class="button is-danger is-outlined  is-pulled-right">Smazat projekt</a></h1> 

        <h2 class="subtitle">
          <i>{{$detaily_projektu->popis}}</i>
        </h2>

    <div class="columns is-4 is-centered">
      
      <div class="column is-one-third">
          <p><i>řeštitelský tým:</i></p>
          <table>
        @foreach($tym as $key=>$value)
          <tr>
            <td>{{$value}}</td>
            <td> 
              <a  href="/smazat_uz_proj/{{$detaily_projektu->idproj}}/{{$key}}"  onclick="return confirm('Opravdu chcete uživatele z tohoto projektu smazat?')" class="button is-danger is-outlined" name="lol" value= "{{$key}}" type="submit"><span class="icon is-small">
            <i class="fas fa-times"></i>
          </span></i></a>
            </td>
          </tr>
        @endforeach
        </table>
        <form method="GET" action="/pridat_clena_tymu/{{$detaily_projektu->idproj}}">
          {{csrf_field()}}
          <div class="field">
            <label class="label">Přidat člena:</label>
             
              <span class="select is-info">
                  <select name="clen" >
                    @foreach($mozni_clenove as $key=>$value)
                      <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                  </select>
              </span>

          </div>

          <div class="control is-centered">

            <button class="button is-info" 
            @if($mozni_clenove->isEmpty())
              disabled
            @endif
            type="submit">Přidat</button>
          </div>
          </form>
          </div>

      
      
      
      <div class="column is-one-third">
        <form method="POST" action="/upravit_manag/">
          {{csrf_field()}}
      <p class="is-medium"><i>manažer projektu: </i>{{$man_name->name}} </p>
      <div class="field">
            <label class="label">Změnit:</label>
             
              <span class="select is-info">
                  <select name="manager" >
                    @foreach($projektaci as $manager)
                      <option value="{{$manager->email}}">{{$manager->name}}</option>
                    @endforeach
                  </select>
              </span>

          </div>
          <input type="hidden" name="idproj" value="{{$detaily_projektu->idproj}}">
          <input type="hidden" name="old_man" value="{{$man_name->email}}">

          <div class="control is-centered">
            <button class="button is-info" type="submit">Změnit</button>
          </div>
          </form>
    </div>


    <div class="column is-one-third">
       
      <p class="is-medium"><i>šablona rejstříku rizik: </p>
      <table>
      @foreach ($sablona as $item_s)
        <tr>
          <td>{{$item_s}}</td>
          <td>
            @if(strcmp($item_s, 'Dopad')===0)

            @elseif(strcmp($item_s, 'Pravděpodobnost')===0)
            @else
            <a  href="/smazat_atribut/{{$detaily_projektu->idproj}}/{{$item_s}}"  onclick="return confirm('Opravdu chcete smazat položku šablony?')" class="button is-danger is-outlined" name="lol" value= "{{$item_s}}" type="submit"><span class="icon is-small">
            <i class="fas fa-times"></i>
          </span></i></a>
          @endif
          </td>
        </tr>
        @endforeach
      {{-- @empty
        <p><i>prázdná</i></p>
      @endforelse --}}
      </table>
       <form method="POST" action="/katalog/vlozdo_projektuA">
          {{csrf_field()}}
      <div class="field">
            <label class="label">Přidat:</label>
             
              <span class="select is-info">
                  <select name="role" >
                    @foreach($mozne_atributy as $atr)
                      <option value="{{$atr}}">{{$atr}}</option>
                    @endforeach
                  </select>
              </span>

          </div>
          <input type="hidden" name="idproj" value="{{$detaily_projektu->idproj}}">
          
          <div class="control is-centered">
            <button class="button is-info" 
            @if($mozne_atributy->isEmpty())
              disabled
            @endif
            type="submit">Přidat atribut</button>
          </div>
          </form>
    </div>

    </div>

   </div>

    </div>


  </div>
  </div>

</div>
@if (\Session::has('success'))
    <script>
            alert("Uloženo.");
        </script>
@endif
@endsection


