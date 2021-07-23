@extends('backend.layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Category List

                    <a class="btn btn-success" href="{{ route('Category.create') }}"> Create New Category</a>
                    </div>
                </div>
                
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card-body">
                    <div class="container mt-5">
                        <table class="table table-bordered mb-5">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categorys as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->status?'Active':'Inactive' }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('Category.edit',$category->id) }}">Edit</a>
                                        <form action="{{ route('Category.destroy',$category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>

                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $categorys->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection