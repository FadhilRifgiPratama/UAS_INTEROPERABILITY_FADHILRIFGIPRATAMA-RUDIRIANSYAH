@extends('frontend.layouts.main')

@section('content')
     <!-- Hero Start -->
     <div class="container-fluid py-5 mb-5 hero-header">
          <div class="container py-5">
              <div class="row g-5 align-items-center">
                  <div class="col-md-12 col-lg-7">
                      <h4 class="mb-3 text-secondary">Energi Olahraga Stylish</h4>
                      <h1 class="mb-5 display-3 text-primary">Eksklusif, Sporty, Modern & Low Budget</h1>
                  </div>
                  <div class="col-md-12 col-lg-5">
                      <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                          <div class="carousel-inner" role="listbox">
                              <div class="carousel-item active rounded">
                                  <img src="frontend-v2/img/background-003.jpg" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide" style="max-height: 500px">
                                  <a href="#" class="btn px-4 py-2 text-white rounded">Eksklusif</a>
                              </div>
                              <div class="carousel-item rounded">
                                  <img src="frontend-v2/img/background-002.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide" style="max-height: 500px">
                                  <a href="#" class="btn px-4 py-2 text-white rounded">Sporty</a>
                              </div>
                              <div class="carousel-item rounded">
                                  <img src="frontend-v2/img/background-005.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide" style="max-height: 500px">
                                  <a href="#" class="btn px-4 py-2 text-white rounded">Modern</a>
                              </div>
                          </div>
                          <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Hero End -->


      <!-- Featurs Section Start -->
      <div class="container-fluid featurs py-5">
          <div class="container py-5">
              <div class="row g-4">
                  <div class="col-md-6 col-lg-3">
                      <div class="featurs-item text-center rounded bg-light p-4">
                          <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                              <i class="fas fa-car-side fa-3x text-white"></i>
                          </div>
                          <div class="featurs-content text-center">
                              <h5>Free Shipping</h5>
                              <p class="mb-0">Free on order over $300</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                      <div class="featurs-item text-center rounded bg-light p-4">
                          <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                              <i class="fas fa-user-shield fa-3x text-white"></i>
                          </div>
                          <div class="featurs-content text-center">
                              <h5>Security Payment</h5>
                              <p class="mb-0">100% security payment</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                      <div class="featurs-item text-center rounded bg-light p-4">
                          <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                              <i class="fas fa-exchange-alt fa-3x text-white"></i>
                          </div>
                          <div class="featurs-content text-center">
                              <h5>30 Day Return</h5>
                              <p class="mb-0">30 day money guarantee</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                      <div class="featurs-item text-center rounded bg-light p-4">
                          <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                              <i class="fa fa-phone-alt fa-3x text-white"></i>
                          </div>
                          <div class="featurs-content text-center">
                              <h5>24/7 Support</h5>
                              <p class="mb-0">Support every time fast</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Featurs Section End -->


      <div class="container-fluid fruite py-5">
          <div class="container py-5">
              <div class="tab-class text-center">
                  <div class="row g-4">
                      <div class="col-lg-4 text-start">
                          <h1>Our Sport Products</h1>
                      </div>
                  </div>
                  <div class="tab-content">
                      <div id="tab-1" class="tab-pane fade show p-0 active">
                          <div class="row g-4">
                              <div class="col-lg-12">
                                  <div class="row g-4">
                                   @foreach ($products as $product )
                                      <div class="col-md-6 col-lg-4 col-xl-4">
                                          <div class="rounded position-relative fruite-item">
                                              <div class="fruite-img">
                                                  @if($product->imageProduct && $product->imageProduct->isNotEmpty())
                                                       <img src="{{ asset('storage/' . $product->imageProduct[0]->image_path) }}" alt="Product Image" class="img-fluid w-100 rounded-top">
                                                  @else
                                                       <img src="frontend-v2/img/image-4.jpg" class="img-fluid w-100 rounded-top" alt="">
                                                  @endif
                                              </div>
                                              <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{ $product->category->name }}</div>
                                              <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                  <h4>{{ $product->name }}</h4>
                                                  <p>{!! \Illuminate\Support\Str::limit($product->description, 200) !!}</p>
                                                  <div class="d-flex justify-content-between flex-lg-wrap">
                                                      <p class="text-dark fs-5 fw-bold mb-0">Rp. {{ number_format($product->price) }}</p>
                                                      <a href="{{ route('homepage.detail', $product->id) }}" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> View Detail</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                   @endforeach
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-12">
                              <div class="pagination d-flex justify-content-center mt-5">
                                  {{ $products->links() }}
                              </div>
                          </div>
                      </div>
                  </div>
                </div>      
            </div>
        </div>
@endsection