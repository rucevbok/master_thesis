@extends('welcome')
@section('content')
<div class="notification">
<div class="section">
  <div class="box">
     <div class="section">
      <h1 class="title">Detail projektu <span class="has-text-info">{{$nazev_proj}}</span></h1>
      <h2 class="subtitle">
        <i>{{$detaily_projektu->popis}}</i>
      </h2>
    
  <div class="columns is-4">
  <div class="column is-one-half">
        <p><i>řešitelský tým:</i>
      @foreach($tym as $name)
        <li>{{$name}}</li>
      @endforeach
    </p>
    </div>
    <div class="column is-one-half">
    <p class="is-medium"><i>manažer projektu: </i>{{$man_name}} </p>
  </div>
 </div>
  </div>
<h3 class="title">Rejstřík rizik projektu </h3>
{{-- {{$hodnotyres}} --}}


<div style="overflow-x: auto;word-wrap: break-word;">
<table style="word-wrap: break-word" class="table">
  <thead>
    <tr>
      <th><abbr title="Název rizika">Název rizika</abbr></th>
		@foreach ($riskse as $result)
			
			<th style="text-align: center;"><abbr title="{{$result->popis}}">{{$result->atribut}}</abbr></th>
		@endforeach 
    </tr>
  </thead>
  <?php $counter=0; ?>
   
	<tbody>
     {{-- res je pocet rizik --}}
  		@for ($a=0;$a<count($res);$a++)
  		
 			<tr>
     {{-- riskse je pocet atributu sablony --}}
          @if($counter%count($riskse)==0)
            <th>{{$hodnotyres[$counter]->cislor}}</th>
          @endif
    			@for ($i = 0; $i < count($riskse); $i++)

    				<td @if(strcmp($hodnotyres[$counter]->hodnota, Auth::user()->email)==0)
      class="is-selected" 
      @endif
      style="word-wrap: break-word; text-align: center;">{{$hodnotyres[$counter]->hodnota}}</td>
    				<?php $counter++; ?>
				@endfor
			</tr>
    	@endfor
	</tbody>
</table>



  <div class="columns">
  <div class="column is-half is-offset-one-quarter">
  <table>

      <tr>
        <th style=" writing-mode: tb-rl;border: 1px solid black;text-align: center;width: 50px;height:50px;top: 50px;vertical-align : middle;" rowspan="5" >DOPAD</th>
        <td id = "5" style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #f39c12;" class="oranzove">{{$case5_1}}</td>
        <td id = "10" style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #f39c12;" class="oranzove">{{$case5_2}}</td>
        <td id = "15" style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #e74c3c;" class="cervene">{{$case5_3}}</td>
        <td id = "20" style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #e74c3c;" class="cervene">{{$case5_4}}</td>
        <td id = "25" style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #e74c3c;" class="cervene">{{$case5_5}}</td>

      </tr>

    <tr>   
    <td id = "4" style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #2ecc71;" class="zelene">{{$case4_1}}</td>
    <td id = "8" style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #f39c12;" class="oranzove">{{$case4_2}}</td>
    <td id = "12" style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #f39c12;" class="oranzove">{{$case4_3}}</td>
    <td id = "16" style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #e74c3c;" class="cervene">{{$case4_4}}</td>
    <td id = "20" style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #e74c3c;" class="cervene">{{$case4_5}}</td>
  </tr>
    <tr>   
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #2ecc71;"class="zelene">{{$case3_1}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #f39c12;"class="oranzove">{{$case3_2}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #f39c12;"class="oranzove">{{$case3_3}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #f39c12;"class="oranzove">{{$case3_4}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #e74c3c;"class="cervene">{{$case3_5}}</td>
  </tr>
    <tr>  
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #2ecc71;"class="zelene">{{$case2_1}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #2ecc71;" class="zelene">{{$case2_2}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #f39c12;"class="oranzove">{{$case2_3}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #f39c12;"class="oranzove">{{$case2_4}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #f39c12;"class="oranzove">{{$case2_5}}</td>
  </tr>
    <tr>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #2ecc71;"class="zelene">{{$case1_1}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #2ecc71;"class="zelene">{{$case1_2}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #2ecc71;"class="zelene">{{$case1_3}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #2ecc71;"class="zelene">{{$case1_4}}</td>
    <td style="  text-align: center;width: 50px;height:50px;border: 1px solid black;background-color: #f39c12;"class="oranzove">{{$case1_5}}</td>
  </tr>
  <tr> 
    <tr>
   <td style="border: 1px solid black"></td>
      <td style="text-align: center;border: 1px solid black" colspan="5"><B>PRAVDĚPODOBNOST</B></td>
    
  </tr>
  </tr>
</table>
</div>
</div>
</div>
</div>
</div>
@endsection


