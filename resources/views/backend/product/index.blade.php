@extends('backend.layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Product List

                    <div style="float: right;">
                    <a class="btn btn-success" href="{{ route('product.create') }}"> Create New Product</a>
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
                                    <th scope="col">F Image</th>
                                    <th scope="col">Status</th>                                    
                                    <th scope="col">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td> <img src="{{asset('images/product/'.$product->fimage)}}" class="img-fluid" alt="fimage"  /></td>
                                    <td>{{ $product->status?'Active':'Inactive' }}</td>                                   
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">Edit</a>
                                        <form action="{{ route('product.destroy',$product->id) }}" method="POST">
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
                    {!! $Products->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection