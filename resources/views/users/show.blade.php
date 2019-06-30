@extends('layouts.app')

@section('title', e($user->fullName()))

@section('content')

    <user-profile :user="{{ json_encode($user) }}"></user-profile>

@endsection