@extends('vue-wrapper')
@section('content')
    <lumen-auth-register :user="{{ json_encode($user) }}"></lumen-auth-register>
@endsection