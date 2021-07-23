@extends('backend.layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User List</div>
                <div class="card-body">
                    <div class="container mt-5">
                        <table class="table table-bordered mb-5">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Users as $User)
                                <tr>
                                    <th scope="row">{{ $User->id }}</th>
                                    <td>{{ $User->name }}</td>
                                    <td>{{ $User->email }}</td>
                                    <td>{{ $User->phone }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $Users->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection