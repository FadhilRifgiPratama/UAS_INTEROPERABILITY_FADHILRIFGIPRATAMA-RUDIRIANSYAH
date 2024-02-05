@extends('admin.layouts.app')

@push('style')
<style>
    #image-preview img {
        max-width: 250px;
        max-height: 250px;
        margin-right: 5px;
    }
    .card {
        height: 100%;
    }
</style>
@endpush

@section('content')
<section class="simple-validation m-5">
    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data Product</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mt-1">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="name">Product Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" id="editor">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="contact">Stock</label>
                                            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" placeholder="stock" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="contact">Price</label>
                                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" placeholder="price" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="contact">Category</label>
                                            <select class="form-select form-control" name="category_id" aria-label="Default select example" required>
                                                @foreach ($category as $data)
                                                    <option value="{{ $data->id }}" {{ $data->id == $product->category_id ? 'selected' : '' }}>
                                                        {{ $data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="contact">Image</label>
                                            <input type="file" name="images[]" class="form-control" placeholder="price" onchange="previewImage(this)" multiple >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-1">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
               <div class="card">
                   <div class="card-header">
                       <h4 class="card-title">Preview Image</h4>
                   </div>
                   <div class="card-content">
                       <div class="card-body">
                           <div id="image-preview">
                               <div class="row">
                                    @foreach($product->imageProduct as $image)
                                        <div class="col-md-4">
                                            <button class="btn btn-danger btn-remove-image mt-4" style="position: absolute; margin-left: 84%" data-image-id="{{ $image->id }}">X</button>
                                            <img src="{{ asset('storage/' . $image->image_path) }}" class="mt-4" alt="Product Image" style="max-width: 250px; max-height: 250px;">
                                        </div>
                                    @endforeach
                                </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </form>
</section>

@endsection

@push('script')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script>
    function previewImage(input) {
        var preview = document.getElementById('image-preview');
        while (preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }

        if (input.files) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var img = document.createElement('img');
                    img.setAttribute('src', e.target.result);
                    img.setAttribute('class', 'img-fluid mt-1');
                    preview.appendChild(img);
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    }
</script>

<script>
    $(document).ready(function () {
        $('.btn-remove-image').on('click', function () {
            var imageId = $(this).data('image-id');

            $.ajax({
                url: '/products/remove-image/' + imageId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        // alert('Image removed successfully');
                        location.reload();
                    } else {
                        alert('Error removing image');
                    }
                },
                error: function () {
                    alert('Error removing image');
                }
            });
        });
    });
</script>

<script>
    CKEDITOR.replace('editor', {
       toolbar: [
          { name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates'] },
          { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
          { name: 'styles', items: ['Styles', 'Format'] },
          { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
          { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
          { name: 'links', items: ['Link', 'Unlink'] },
          { name: 'insert', items: ['HorizontalRule', 'Smiley', 'SpecialChar'] },
          { name: 'tools', items: ['Maximize'] },
          { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] }
       ]
    });
 </script>
@endpush