@extends('layouts.app')

@section('content')

<estoque-component user={{Auth::User()->name}}>

</estoque-component>


@endsection