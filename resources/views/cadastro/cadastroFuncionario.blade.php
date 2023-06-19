@extends('layouts.app')

@section('content')

<cadastro-funcionario-component user={{Auth::User()->name}}>

</cadastro-funcionario-component>


@endsection