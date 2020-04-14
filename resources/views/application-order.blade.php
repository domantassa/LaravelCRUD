@extends('layout')
@section('content')


    <div class="col">
    <h1 class="display-3 mb-3">Application orders</h1>
    <a href="{{ url('application-order/create') }}"><button type="button"  class="mb-2 btn  create">Register application order</button></a>
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Started at</th>
            <th scope="col">End term</th>
            <th scope="col">Name</th>
            <th scope="col">Price ($)</th>
            <th scope="col">Development software</th>
            <th scope="col">Development methodology</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($application_orders as $application_order)
            
                <tr>
                <th scope="row">{{$application_order->id_Application_order}}</th>
                <th scope="row">{{$application_order->Started_at}}</th>
                <th scope="row">{{$application_order->End_term}}</th>
                <th scope="row">{{$application_order->NAME}}</th>
                <th scope="row">{{$application_order->Price}}</th>
                <th scope="row">{{$application_order->Development_software}}</th>
                <th scope="row">{{$application_order->Development_methodology}}</th>
                <td>
                    <form class="icons" action="{{route('application-order.edit', ['application_order' => $application_order->id_Application_order])}}" method="get">
                    @csrf
                    <a onclick='this.parentNode.submit()'><i  class="fa fa-edit mr-3"></i></a>
                    </form>
                    
                    <form class="icons" action="{{route('application-order.destroy', ['application_order' => $application_order->id_Application_order])}}" method="post">
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