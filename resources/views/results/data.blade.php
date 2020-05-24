@extends('layout')
@section('content')


    <div class="col">
    <h1 class="display-3 mb-3">Report</h1>
    <a href="{{ url('results') }}"><button type="button"  class="mb-2 btn  create">Back</button></a>
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
            <th class="text-align-center" colspan="6">Klientas</th>
            </tr>
            <tr>
            <th scope="col">Produko pav.</th>
            <th class="tdNumber" scope="col">Started at</th>
            <th class="tdNumber" scope="col">End term</th>
            <th scope="col" class="tdNumber">Kiekis</th>
            <th scope="col">Price</th>
            <th scope="col">Developer</th>
            </tr>
        </thead>
        <tbody>
        {{$temp = ''}}
        @foreach($partData as $onePartData)
        
        @foreach($result as $oneResult)
        @if($onePartData->client_full_name == $oneResult->client_full_name)
        @if ($temp != $oneResult->client_full_name)
        
            <thead class="thead-dark">
                <tr>
                <th class="text-align-center" colspan="6">{{$oneResult->client_full_name}}</th>
                </tr>
            </thead>
        @else
        <thead class="thead-dark"></thead>
        @endif
        
                
                <th scope="row">{{$oneResult->NAME}}</th>
                <th scope="row" class="tdNumber">{{$oneResult->Started_at}}</th>
                <th scope="row" class="tdNumber">{{$oneResult->End_term}}</th>
                <th scope="row" class="tdNumber">{{$oneResult->Kiekis}}</th>
                <th scope="row">{{$oneResult->Price}}</th>
                <th scope="row">{{$oneResult->developer_full_name}}</th>
            
        <div style="display:none">{{$temp = $oneResult->client_full_name}}</div>
        @endif
        @endforeach
        <thead class="thead-dark"></thead>
                <th class="darker2" scope="row"></th>
                <th class="darker2 tdNumber" scope="row" ></th>
                <th class="darker2 tdNumber" scope="row"></th>
                <th class="darker2 tdNumber" scope="row" >{{$onePartData->Kiekis}}</th>
                <th class="darker2" scope="row">{{$onePartData->Suma}}</th>
                <th class="darker2" scope="row">Iš viso</th>
        @endforeach          
        <thead class="thead-dark">
        <th class="darker2" scope="row"></th>
                <th class="darker2 tdNumber" scope="row" ></th>
                <th class="darker2 tdNumber" scope="row"></th>
                <th class="darker2 tdNumber" scope="row" >{{$suma[0]->Kiekis}}</th>
                <th class="darker2" scope="row">{{$suma[0]->Suma}}</th>
                <th class="darker2" scope="row">Iš viso</th>
        </thead>
                
        </tbody>
        </table>
    </div>
    
    </div>


@endsection