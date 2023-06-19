@extends('layouts.app')

@section('content')

<dashboard-component user={{Auth::User()->name}}>

</dashboard-component>


@endsection