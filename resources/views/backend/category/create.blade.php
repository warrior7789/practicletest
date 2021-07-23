@extends('backend.layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Create New Category

                    <a class="btn btn-success" href="{{ route('Category.index') }}"> Back</a>
                    </div>
                </div>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('Category.store') }}" method="POST">
                        @csrf

                         <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>title:</strong>
                                    <input type="text" name="title" class="form-control" placeholder="Title">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                  <strong>Status:</strong>
                                   
                                   <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked>
                                     <label class="form-check-label" for="inlineRadio1">Active</label>
                                   </div>
                                   <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                                     <label class="form-check-label" for="inlineRadio2">Inactive</label>
                                   </div>
                                </div>

                               

                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection