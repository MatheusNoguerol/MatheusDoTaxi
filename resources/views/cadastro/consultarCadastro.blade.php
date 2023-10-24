@extends('layouts.app')

@section('content')

<consultar-cadastro-component user={{Auth::User()->name}}>

</consultar-cadastro-component>


@endsection