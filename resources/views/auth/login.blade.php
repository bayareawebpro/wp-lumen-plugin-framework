@extends('vue-wrapper')
@section('content')
    <lumen-auth-login :user="{{ json_encode($user) }}"></lumen-auth-login>
@endsection