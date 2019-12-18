@extends('welcome')
@section('content')
<div class="section">
<div class="box">
     <h3 class="title">Kontrolní seznamy</h3>
<div class="columns">

  <div class="column is-one-third">
    <h6 class="title">Zvolte projekt</h6>

    @foreach($moje_projekty as $project)
    <li> <a href="/checklist/{{$project->idproj}}">{{$project->nazev}}</a> </li>
    @endforeach

  </div>

  <div class="column auto">
    <div class="box">
    <h6 class="subtitle">Kontrolní seznam projektu </h6>
 
    <table>
      <thead>
        <th>Číslo</th>
        <th>Položka</th>
        <th>Komentář</th>
        <th>Splněno</th>
        <th>Smazat</th>
      </thead>


      @foreach($checklist_projektu as $task)
      <form method="post" action="/checklist/{project}/uprav">
        {{csrf_field()}}
        <tr>
          

            <td>
              {{$task->poradi}}

            </td>
            <td>
              <div class="field">
                <div class="control">
                  
                    <input class="textarea" type="textarea" name="{{$task->poradi}}*polozka" value="{{$task->polozka}}">
                 
                </div>
              </div>
            </td>
            <td>
              <div class="field">
                <div class="control">
                  
                    <input class="textarea" type="textarea" name="{{$task->poradi}}*komentar" value="{{$task->komentar}}">
               
                </div>
              </div>
            </td>
            <td>
              <div class="field">
                <div class="control">
                  <label class="containerr">One
                    <input class="checkbox" type="checkbox" name="splneno[]" value="{{$task->poradi}}" @if($task->splneno==true) checked @endif>
                     <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </td>
            <td>
              
                <button class="button is-danger is-outlined" name="smazat" value= "{{$task->poradi}}" type="submit"> <span class="icon is-small">
                <i class="fas fa-times"></i>
                </span></i></button>
              

            </td>
      

          
        </tr>
      @endforeach
      <tr>
        <td>
          <input type="hidden" name="idproj" value="{{$id_proj}}" >
          <div class="field">
                <div class="control">
                  <input class="button is-info" type="submit" name="" value="Upravit">
                </div>
          </div>
      </td>
      </tr>
      
 </form>
</table>
</div>

 <form method="post" action="/checklist/insert">
   {{csrf_field()}}
    </table>
<div class="box">
  <h6 class="subtitle">Přidat položku</h6>
  <table>
        <thead>
          <th>Pořadí</th>
          <th>Položka</th>
          <th>Komentář</th>
          <th>Splněno</th>
      </thead>
      <tbody>
  <tr>
    <td>
      -
    </td>
            <td>
              <div class="field">
                <div class="control">
              <input class="textarea" type="textarea" name="polozka" placeholder="Položka" value="">
                </div>
              </div>
            </td>
            <td>

              <input class="textarea" type="textarea" name="komentar" placeholder="Komentář" value="">
            
            </td>
            <td>
               <div class="field">
                <div class="control">
              <input type="checkbox" name="" disabled>
              </div>
            </div>
            </td>
  </tr>
  <tr>
    <td>
      <div class="field">
        <div class="control">
          <input type="hidden" name="idproj" value="{{$id_proj}}" >
          <input class="button is-info" type="submit" name="" value="Vložit">
        </div>
      </div>
    </td>

  </tr>
</tbody>
</table>
</form>

</div>
</div>

</div>
</div>
</div>
@endsection



















