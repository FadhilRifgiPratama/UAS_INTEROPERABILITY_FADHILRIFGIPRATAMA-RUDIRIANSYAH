@extends('frontend.layouts.main')

@section('content')
     <!-- Single Page Header start -->
     <div class="container-fluid page-header py-5">
          <h1 class="text-center text-white display-6">Checkout</h1>
          <ol class="breadcrumb justify-content-center mb-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Pages</a></li>
              <li class="breadcrumb-item active text-white">Checkout</li>
          </ol>
      </div>
      <!-- Single Page Header End -->
      <!-- Checkout Page Start -->
      <div class="container-fluid py-5">
          <div class="container py-5">
              <h1 class="mb-4">Billing details</h1>
              <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="row g-5">
                      <div class="col-md-12 col-lg-6 col-xl-7">
                          <div class="form-item">
                              <label class="form-label my-3">Address <sup>*</sup></label>
                              <input type="text" name="address" class="form-control" placeholder="House Number Street Name">
                              @error('address')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                          <div class="form-item">
                              <label class="form-label my-3">Town/City<sup>*</sup></label>
                              <input type="text" name="town_city" class="form-control">
                              @error('town_city')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                          <div class="form-item">
                              <label class="form-label my-3">Country<sup>*</sup></label>
                              <input type="text" name="country" class="form-control">
                              @error('country')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                          <div class="form-item">
                              <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                              <input type="text" name="postcode" class="form-control">
                              @error('postcode')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                          <div class="form-item">
                              <label class="form-label my-3">Phone Number<sup>*</sup></label>
                              <input type="tel" name="phone_number" class="form-control">
                              @error('phone_number')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                          <hr>
                          <div class="form-item">
                              <textarea name="order_notes" class="form-control"  cols="30" rows="11" placeholder="Oreder Notes (Optional)"></textarea>
                              @error('order_notes')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-6 col-xl-5">
                          <div class="table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th scope="col">Products</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Price</th>
                                          <th scope="col">Quantity</th>
                                          <th scope="col">Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <th scope="row">
                                              <div class="d-flex align-items-center mt-2">
                                                  <img src="{{ asset('storage/' . $order->product->imageProduct[0]->image_path) }}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                  {{-- <img src="frontend-v2/img/vegetable-item-2.jpg" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt=""> --}}
                                              </div>
                                          </th>
                                          <td class="py-5">{{ $order->product->name }}</td>
                                          <td class="py-5">Rp.{{ number_format($order->product->price) }}</td>
                                          <td class="py-5">{{ $order->quantity }}</td>
                                          <td class="py-5">{{ number_format($order->subtotal) }}</td>
                                      </tr>
                                      <tr>
                                          <th scope="row">
                                          </th>
                                          <td class="py-5">
                                              <p class="mb-0 text-dark">Shipping</p>
                                          </td>
                                          <td colspan="3" class="py-5">
                                              <div class="form-check text-start">
                                                <input type="hidden" name="shipping" value="0"> <!-- Hidden field for false value -->
                                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-1" name="shipping" value="1">
                                                  <label class="form-check-label" for="Shipping-1">Rp. 15.000</label>
                                                  @error('shipping')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                              </div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">
                                          </th>
                                          <td class="py-5">
                                              <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                          </td>
                                          <td class="py-5"></td>
                                          <td class="py-5">
                                              <div class="py-3 border-bottom border-top" style="width: max-content">
                                                  <p class="mb-0 text-dark">Rp. {{ number_format($order->subtotal + 15000) }}</p>
                                              </div>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                          <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <label for="paymentMethod" class="form-label my-3">Payment Method<sup>*</sup></label>
                                <select class="form-select" id="paymentMethod" name="payment_method">
                                    <option value="transfer">Direct Bank Transfer</option>
                                    <option value="cash_on_delivery">Cash On Delivery</option>
                                    <option value="paypal">Paypal</option>
                                </select>
                                @error('payment_method')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                            </div>
                        </div>
                          <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                              <input type="hidden" name="product_id" value="{{ $order->product_id }}">
                              @error('product_id')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                              <input type="hidden" name="quantity" value="{{ $order->quantity }}">
                              @error('quantity')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                              <input type="hidden" name="subtotal" value="{{ ($order->subtotal + 15000) }}">
                              @error('subtotal')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                              <button type="sumbit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
      <!-- Checkout Page End -->
@endsection