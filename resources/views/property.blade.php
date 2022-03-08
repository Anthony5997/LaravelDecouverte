@extends('base')

@section('content')

@foreach ($properties as $property)
<a href="">
<div class="card">
    <img src="https://media.istockphoto.com/vectors/house-flat-icon-vector-illustration-vector-id1072185464?k=20&m=1072185464&s=612x612&w=0&h=CM_SfnMMl-jJ8AFHBa4b_V2LThEt4JIcPQfzUb9rMLM=" alt="Avatar" style="width:100px; heigth:100px;">
    <div class="container">
      <h4><b>{{ $property->title}}</b></h4>
      <p>{{$property->description}}</p>
      <p>{{$property->price}} Euro</p>
    </div>
  </div>
</a>
  @endforeach

@stop