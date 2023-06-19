@extends('layouts.app')

@section('content')

<adicionar-produto-component  user={{Auth::User()->name}}>

</adicionar-produto-component>


@endsection