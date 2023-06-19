@extends('layouts.app')

@section('content')

<consulta-cadastro-component user={{Auth::User()->name}}>

</consulta-cadastro-component>


@endsection