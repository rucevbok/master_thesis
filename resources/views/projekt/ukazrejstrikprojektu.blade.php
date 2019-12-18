@extends('welcome')
@section('content')
<h2>Product Name: </h2>
<p>{{ $produkt->nazev }}</p>

<h3>Product Belongs to</h3>

<ul>
    @foreach($produkt->polozky_sablony as $atributky)
    <li>{{ $atributky->atribut }}</li>
    @endforeach
</ul>

@endsection


