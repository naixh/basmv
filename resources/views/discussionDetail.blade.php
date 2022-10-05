@extends('layout')

@section('content')

<div class="container" align="center">
    <h1>Discussion Details for {{@$data ? $data->title : "EMPTY"}}</h1>
</div>

@endsection
