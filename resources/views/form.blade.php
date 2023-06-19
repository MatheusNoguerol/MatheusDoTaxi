olá
aaa

<div id="app">
    <example-component></example-component>
</div>



@foreach ($cliente as $cliente)

<h1>{{$cliente->id}}</h1>
<h1>{{$cliente->nome}}</h1>
<h1>{{$cliente->email}}</h1>
<h1>{{$cliente->msg}}</h1>

@endforeach