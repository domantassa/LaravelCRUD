@extends('layout')
@section('content')


    <div class="col">
    <h1 class="display-3 mb-3">Software developers</h1>
    <a href="{{ url('software-developer/create') }}"><button type="button"  class="mb-2 mr-2 btn create">Register software developer</button></a>
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Lastname</th>
            <th scope="col">Email</th>
            <th scope="col" style="width:9rem">Phone</th>
            <th class="tdNumber" scope="col">Experience (years)</th>
            <th scope="col">Programming language</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($software_developers as $software_developer)
                <tr>
                <th scope="row">{{$software_developer->id_Software_developer}}</th>
                <td>{{$software_developer->NAME}}</td>
                <td>{{$software_developer->Last_name}}</td>
                <td>{{$software_developer->Email}}</td>
                <td>{{$software_developer->Phone}}</td>
                <td class="tdNumber">{{$software_developer->Experience}}</td>
                <td>{{$software_developer->Best_known_language}}</td>
                <td>
                    <form class="icons" action="{{route('software-developer.edit', ['software_developer' => $software_developer->id_Software_developer])}}" method="get">
                    @csrf
                    <a onclick='this.parentNode.submit()'><i  class="fa fa-edit mr-3"></i></a>
                    </form>
                    
                    <form class="icons" action="{{route('software-developer.destroy', ['software_developer' => $software_developer->id_Software_developer])}}" method="post">
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