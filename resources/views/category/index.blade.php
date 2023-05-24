@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Manage Category
            <button class="btn btn-success" style="float:right;" type="button" data-toggle="modal" data-target="#categoryModal">Add +</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered myTable">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($category as $data)

                    <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$data->name}}</td>
                     <td><img src="{{asset('cate_icons')}}/{{$data->icon}}" alt="uploaded-image" height="40px" width="40px"></td>
                     <td>

                        @if(auth()->user()->id==$data->added_by || auth()->user()->role == 'admin')
                        <button onclick="EditCategory('{{url('edit-category',[Crypt::encrypt($data->id)])}}')"  class="btn btn-success">Edit</button>
                        <button onclick="DeleteData('{{url('delete/category',[Crypt::encrypt($data->id)])}}','Category')" class="btn btn-danger">Delete</button>
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
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>

      </div>
      <div class="modal-body">
       <form action="{{url('category/manage')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category name" required>
        </div>
        <input type="hidden" name="id" id="updater">
        <div class="form-group">
            <label for="">Icon</label>
            <input type="file" class="form-control" id="file" name="icon" required>

        </div>
        <div id="image"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="CloseModal('categoryModal')">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
@push('script')
<script>
        function EditCategory(url)
        {
            var link_url = url;
            $.ajax({
                type : "GET",
                url : link_url,
                data:'',
                success:function(data)
                {
                    document.getElementById('file').removeAttribute('required');
                    document.getElementById('name').value = data.name;
                    document.getElementById('updater').value = data.id;
                    document.getElementById('image').innerHTML = '<img src="{{asset("cate_icons")}}/'+data.icon+'" height="60px" width="60px"/>';
                    document.getElementById('exampleModalLabel').innerHTML ="Update Category";
                    $('#categoryModal').modal('toggle');

                }

            });
        }
        function CloseModal(id){
             $('#'+id).modal('hide');
        }
    </script>

@endpush
@endsection
