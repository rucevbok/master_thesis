@extends('welcome')
@section('content')

<h1 class="title">Úprava rejstříku rizik projektu <span class="has-text-info"></span></h1>





{{$cnt=0}}
{{$cnt2=1}}
@for ($i = 0; $i < ($pocet_rizik); $i++)
    {{ $map[$i] }}
    @for ($a = $cnt*(count($articless)/$pocet_rizik); $a < $cnt2*(count($articless)/$pocet_rizik); $a++)
      <li>{{$articless[$a]['atribut']}} : {{$articless[$a]['hodnota']}}</li>
     
    @endfor
    {{$cnt=$cnt+1}}
    {{$cnt2=$cnt2+1}}
   

@endfor


@endsection


