@extends('layout')
@section('content')


    <div class="col">
    <h1 class="display-3 mb-3">Offices</h1>
    <a href="{{ url('office/create') }}"><button type="button"  class="mb-2 btn  create">Register office</button></a>
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Population</th>
            <th scope="col">Establishment year</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offices as $office)
            
                <tr>
                <th scope="row">{{$office->id_Office}}</th>
                <th scope="row">{{$office->NAME}}</th>
                <td >{{$office->Address}}</td>
                <td class="tdNumber">{{$office->Population}}</td>
                <td>{{$office->Establishment_year}}</td>
                <td>
                    <form class="icons" action="{{route('office.edit', ['office' => $office->id_Office])}}" method="get">
                    @csrf
                    <a onclick='this.parentNode.submit()'><i  class="fa fa-edit mr-3"></i></a>
                    </form>
                    
                    <form class="icons" action="{{route('office.destroy', ['office' => $office->id_Office])}}" method="post">
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