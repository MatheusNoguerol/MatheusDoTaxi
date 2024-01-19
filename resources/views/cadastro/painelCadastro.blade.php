@extends('layouts.app')

@section('content')

<painel-cadastro-component user={{Auth::User()->name}}>

</painel-cadastro-component>


@endsection