@extends('layouts.app')

@section('content')

<cadastrar-segurado-component user={{Auth::User()->name}}>

</cadastrar-segurado-component>


@endsection