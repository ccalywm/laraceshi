@extends('layouts.app')
@section('title')
@section('content')
<div class="jumbotron">
    <h1>Hello Laravel</h1>
    <p class="lead">
     这里是CMS主页
    </p>
    <p>
      一切，将从这里开始。
    </p>
    <p>
    <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
    </p>
  </div>
@stop