@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Data Product</h1>
     </div>

     <!-- Content Row -->
     <div class="card shadow mb-4">
          <div class="card-header py-3">
              <a href="{{ route('products.create') }}" class="m-0 font-weight-bold btn btn-success">Tambah Data</a>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th>Name</th>
                              {{-- <th>Description</th> --}}
                              <th>Price</th>
                              <th>Stock</th>
                              <th>Category</th>
                              <th>Image</th>
                              <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                {{-- <td>{{ \Illuminate\Support\Str::limit($product->description, 50) }}</td> --}}
                                <td>{{ number_format($product->price, 0, '', '') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    @if($product->imageProduct && $product->imageProduct->isNotEmpty())
                                        <img src="{{ asset('storage/' . $product->imageProduct[0]->image_path) }}" alt="Product Image" style="max-width: 100px; max-height: 100px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td class="text-center">

                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">Edit</a>
                                    {{-- <a href="{{ route('products.show', $product->id) }}" class="btn btn-success">View</a> --}}
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>

 </div>
@endsection