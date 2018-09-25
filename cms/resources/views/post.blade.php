@extends('layouts.app')

@section('content')

<h1>Post Page {{$name}} {{$id}}</h1>

<h2>People:</h2>
@if (count($people))
  <ul>
    @foreach ($people as $person)
      <li>{{$person}}</li> 
    @endforeach
  </ul>
@endif

@endsection