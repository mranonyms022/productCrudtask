@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
           Manage Products
            <button class="btn btn-success" style="float:right;" type="button" onclick="CloseModal('productModal')">Add +</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered myTable">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $data)
                    <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$data->product_name}}</td>
                     <td>{{$data->description}}</td>
                     <td>{{$data->price}}</td>

                     <td>{{implode(',',$data->category_id)}}</td>
                     <td><img src="{{asset('products_image')}}/{{$data->image}}" alt="" height="40px" width="40px"></td>
                     <td>
                        @if(auth()->user()->id == $data->added_by || auth()->user()->role=='admin')
                        <button onclick="EditProduct('{{url('get/product-details',[Crypt::encrypt($data->id)])}}')"  class="btn btn-success">Edit</button>
                        <button onclick="DeleteData('{{url('delete/product',[Crypt::encrypt($data->id)])}}','Product')" class="btn btn-danger">delete</button>
                        @else
                        You cannot perform any action
                        @endif
                     </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- modal for adding category --}}
<div class="modal fade" id="productModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>

      </div>
      <div class="modal-body">
       <form action="{{url('store/product')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" name="product_name" id="name" placeholder="Enter Category name" required>
        </div>
        <input type="hidden" name="id" id="updater">
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" id="description" cols="50" rows="10" class="form-control" required></textarea>

        </div>
        <div class="form-group">
            <label for="">Category</label>
           <select name="category[]" class="form-control selectpicker" id="" title="Please choose category" multiple data-live-search="true" required>
            @foreach(\App\Models\Category::all() as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
           </select>

        </div>
        <div class="form-group">
            <label for="">Price</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" required>
         </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" class="form-control" id="file" name="icon" required>

        </div>
        <div id="image"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="CloseModal('productModal')">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
@push('script')
<script>
        function EditProduct(url)
        {
            var link_url = url;
            $.ajax({
                type : "GET",
                url : link_url,
                data:'',
                success:function(data)
                {
                    document.getElementById('file').removeAttribute('required');
                    document.getElementById('name').value = data.product_name;
                    document.getElementById('description').innerHTML = data.description;
                    document.getElementById('price').value = data.price;
                    document.getElementById('updater').value = data.id;
                    document.getElementById('image').innerHTML = '<img src="{{asset("products_image")}}/'+data.image+'" height="60px" width="60px"/>';
                    document.getElementById('exampleModalLabel').innerHTML ="Update Product";
                    $('#productModal').modal('toggle');

                }

            });
        }
        function CloseModal(id){
             $('#'+id).modal('toggle');
        }
    </script>

@endpush
@endsection
