@extends('layout')
@section('content')


    <div class="col">
    <h1 class="display-3 mb-3">Cities</h1>
    <a href="{{ url('city/create') }}"><button type="button"  class="mb-2 btn  create">Register city</button></a>
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
            <th scope="col">ID</th>
            <th class="tdNumber" scope="col">Residents</th>
            <th class="tdNumber" scope="col">Area (Km)</th>
            <th scope="col">Number_of_residents</th>
            <th scope="col">Mayor</th>
            <th class="tdNumber" scope="col">Has bussiness center</th>
            <th scope="col">Country</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cities as $city)
            
                <tr>
                <th scope="row">{{$city->id_City}}</th>
                <td class="tdNumber">{{$city->Number_of_residents}}</td>
                <td class="tdNumber">{{$city->Area_square_km}}</td>
                <td>{{$city->NAME}}</td>
                <td>{{$city->Mayor}}</td>
                @if ($city->Has_bussiness_center)
                <td style="text-align: center;"><i  class="fa fa-building"></i></td>
                @else
                <td style="text-align: center;"><i class="fa fa-minus"></i></td>
                @endif
                <td>{{$city->Country}}</td>
                <td>
                    <form class="icons" action="{{route('city.edit', ['city' => $city->id_City])}}" method="get">
                    @csrf
                    <a onclick='this.parentNode.submit()'><i  class="fa fa-edit mr-3"></i></a>
                    </form>
                    
                    <form class="icons" action="{{route('city.destroy', ['city' => $city->id_City])}}" method="post">
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