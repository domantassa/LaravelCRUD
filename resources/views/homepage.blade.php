@extends('layout')
@section('content')


    <div class="col">
    <h1 class="display-3 mb-3">Clients</h1>
    <a href="{{ url('client/create') }}"><button type="button"  class="mb-2 btn create">Create client</button></a>
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Lastname</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th class="tdNumber" scope="col">Amount of orders</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            
                <tr>
                <th scope="row">{{$client->id_Client}}</th>
                <td>{{$client->NAME}}</td>
                <td>{{$client->Last_name}}</td>
                <td>{{$client->Email}}</td>
                <td>{{$client->Phone}}</td>
                <td class="tdNumber">{{$client->Amount_of_orders}}</td>
                <td>
                    <form class="icons" action="{{route('client.edit', ['client' => $client->id_Client])}}" method="get">
                    @csrf
                    <a onclick='this.parentNode.submit()'><i  class="fa fa-edit mr-3"></i></a>
                    </form>
                    
                    <form class="icons" action="{{route('client.destroy', ['client' => $client->id_Client])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <a onclick='this.parentNode.submit()'><i class="fa fa-trash"></i></a>
                    </form>
                </td>
                </tr>
            @endforeach
                   

        </tbody>
        </table>
</div>
    </div>


@endsection