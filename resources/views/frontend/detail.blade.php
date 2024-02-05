@extends('frontend.layouts.main')

@section('content')
      <!-- Single Page Header start -->
 <div class="container-fluid page-header py-5">
     <h1 class="text-center text-white display-6">Shop Detail</h1>
     <ol class="breadcrumb justify-content-center mb-0">
         <li class="breadcrumb-item"><a href="/">Home</a></li>
         <li class="breadcrumb-item"><a href="#">Pages</a></li>
         <li class="breadcrumb-item active text-white">{{ $product->name }}</li>
     </ol>
 </div>
 <!-- Single Page Header End -->


 <!-- Single Product Start -->
 <div class="container-fluid py-5 mt-5">
     <div class="container py-5">
         <div class="row g-4 mb-5">
             <div class="col-lg-12 col-xl-12">
                 <div class="row g-4">
                     <div class="col-lg-6">
                         <div class="border rounded">
                             <a href="#">
                                @if($product->imageProduct && $product->imageProduct->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->imageProduct[0]->image_path) }}" alt="Product Image" class="img-fluid w-100">
                                @else
                                    <img class="img-fluid w-100" src="{{ asset('frontend/img/heor-1.jpg') }}" alt="">
                                @endif
                             </a>
                         </div>
                     </div>
                     <div class="col-lg-6">
                         <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                         <p class="mb-3">Category: {{ $product->category->name }}</p>
                         <h5 class="fw-bold mb-3">Rp. {{ number_format($product->price) }}</h5>
                         <p class="mb-4">{!! \Illuminate\Support\Str::limit($product->description, 300) !!}</p>
                         <div class="input-group quantity mb-2" style="width: 100px;">
                             <div class="input-group-btn">
                                 <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                     <i class="fa fa-minus"></i>
                                 </button>
                             </div>
                             <input type="text" id="quantityInput" class="form-control form-control-sm text-center border-0" value="1">
                             <div class="input-group-btn">
                                 <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                     <i class="fa fa-plus"></i>
                                 </button>
                             </div>
                         </div>
                         <form id="checkoutForm" action="{{ route('homepage.order') }}" method="POST" class="form-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_price" value="{{ $product->price }}">
                            <input type="hidden" id="quantityHidden" name="quantity" value="1">
                            <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Order Product</button>
                        </form>
                     </div>
                     <div class="col-lg-12">
                         <nav>
                             <div class="nav nav-tabs mb-3">
                                 <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                     id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                     aria-controls="nav-about" aria-selected="true">Description</button>
                             </div>
                         </nav>
                         <div class="tab-content mb-5">
                             <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                 {!! $product->description !!}
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Single Product End -->
@endsection

@push('script')
<script>
    // Add event listeners to the plus and minus buttons
    document.querySelector('.btn-minus').addEventListener('click', function() {
        updateQuantity(-1);
    });

    document.querySelector('.btn-plus').addEventListener('click', function() {
        updateQuantity(1);
    });

    // Function to update the quantity input and hidden input values
    function updateQuantity(change) {
        const quantityInput = document.getElementById('quantityInput');
        const quantityHidden = document.getElementById('quantityHidden');

        let currentQuantity = parseInt(quantityInput.value);
        currentQuantity += change;

        // Ensure the quantity is not less than 1
        currentQuantity = Math.max(1, currentQuantity);

        quantityInput.value = currentQuantity;
        quantityHidden.value = currentQuantity;
    }
</script>
@endpush