@extends('layouts.app')

@section('scripts')
<!-- JS ET CSS -->
@endsection

@section('content')
<x-alert>
<div>{{$user->mail}}</div>
@endsection