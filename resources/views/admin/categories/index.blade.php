@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Data Category</h1>
     </div>

     <!-- Content Row -->
     <div class="card shadow mb-4">
          <div class="card-header py-3">
              <button type="button" class="m-0 font-weight-bold btn btn-success" data-toggle="modal" data-target="#createModal">
                  Tambah Data
              </button>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th class="text-center">No</th>
                              <th>Name</th>
                              <th class="text-center" style="width: 400px">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $data)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal-{{ $data->id }}">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('categories.destroy', $data->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>

 </div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
@foreach ($categories as $data)
    <div class="modal fade" id="editModal-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $data->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-{{ $data->id }}">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('categories.update', $data->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_category_name">Category Name</label>
                            <input type="text" class="form-control" id="edit_category_name" name="name" value="{{ $data->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach



@endsection
