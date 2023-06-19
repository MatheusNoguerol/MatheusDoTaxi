@extends('layouts.app')

@section('content')

<cadastro-cliente-component user={{Auth::User()->name}}>

</cadastro-cliente-component>


@endsection