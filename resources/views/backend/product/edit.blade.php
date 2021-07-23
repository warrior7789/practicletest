@extends('backend.layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Create New product
                     <div style="float: right;">
                     <a class="btn btn-success" href="{{ route('product.index') }}"> Back</a>
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
                    <form action="{{ route('product.update',$Product->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                         @method('PUT')

                         <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Product Name</strong>
                                    <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $Product->title }}">
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Category</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="category_id[]" multiple>
                                        @foreach ($categorys as $category)
                                            <option value="{{ $category->id }}"  @if (in_array($category->id, $prod_cat)) selected  @endif >{{ $category->title }}</option>
                                        @endforeach
                                         
                                    </select>
                                  </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label class="control-label">Image <small class="text-muted">(Preferred Size:
                                            400*400)</small></label>
                                            <div class="input-group">                                              
                                               <div class="input-group-prepend">
                                                 <img src="{{ asset('images/product/'.$Product->fimage) }}"class="img-thumbnail" alt="Featured Image"  />
                                                  
                                               </div>                                              
                                               <div class="custom-file">
                                                  <input type="file" name="image" class="custom-file-input"
                                                     id="inputGroupFile01">
                                                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Description </label>
                                    <textarea class="form-control" id="description" placeholder="Enter the Description" name="description">{{ $Product->description }}</textarea>
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

                            <div class="col-md-12">
                                <div class="row">
                                @if(!empty($Product->images))
                                    @foreach($Product->images as $images)
                                    <div class="col-md-3" id="image_div_{{ $images->id }}">
                                        <div class="card">
                                          <div class="card-body">
                                              <img src="{{ asset('images/product/'.$Product->id.'/'.$images->name) }}"class="img-thumbnail" alt="Featured Image"  />
                                          </div>
                                          <div class="card-footer">
                                           
                                            <button class="delete_image" type="button" data-id="{{ $images->id }}" data-url="{{ route('admin.imageDelete',$images->id) }}">Delete</button></a>
                                          </div>
                                        </div>

                                    </div>
                                    @endforeach
                                @endif
                                </div>
                                <h4>Upload Product Gallary Image Multilpe select</h4>
                                <input type="file" name="images[]" multiple>
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(".custom-file-input").on("change", function() {
        var e = $(this).val();
        $(this).next(".custom-file-label").html(e);
        if($(this).parents('.input-group').has('.input-group-prepend').length) {
            readURL(this);      
        }
    });
    function readURL(input) {       
        if (input.files && input.files[0]) {            
            var reader = new FileReader();

            reader.onload = function(e) {
              $(input).parents('.input-group').children('.input-group-prepend').children('img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function () {
        //$('.ckeditor').ckeditor();
    });

    CKEDITOR.replace('description', {
       filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
       filebrowserUploadMethod: 'form'
    });

    $(document).on("click", ".delete_image", function(){
       
        var id= $(this).attr("data-id");
        var url= $(this).attr("data-url");
        $.ajax({
            url: url,            
            dataType: "JSON",
            method: "GET",
            success: function(data){
                if(data.status == 1){
                   $("#image_div_"+id).fadeOut();
                }
            },
            error: function (data){}
        });
    });
</script>
@endsection