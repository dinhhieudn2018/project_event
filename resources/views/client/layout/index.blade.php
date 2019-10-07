@extends('client.layout.master')

@section('slide')
  @include('client.layout.slide')
@endsection

@section('content')
    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Featured Products</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
              @foreach($products as $value)
                <div class="item">
                  <div class="block-4 text-center">
                    <figure class="block-4-image">
                      <img src="img/upload/product/{{ $value->image }}" alt="Image placeholder" class="img-fluid">
                    </figure>
                    <div class="block-4-text p-4">
                      <h3><a href="product-detail/{{ $value->id }}">{{ $value->name }}</a></h3>
                      <p class="mb-0">{{ $value->title }}</p>
                      <p class="text-primary font-weight-bold">{{ number_format($value->price) }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Big Sale!</h2>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 mb-5">
            <a href="#"><img src="assets/client/images/blog_1.jpg" alt="Image placeholder" class="img-fluid rounded"></a>
          </div>
          <div class="col-md-12 col-lg-5 text-center pl-md-5">
            <h2><a href="#">50% less in all items</a></h2>
            <p class="post-meta mb-4">By <a href="#">Carl Smith</a> <span class="block-8-sep">&bullet;</span> September 3, 2018</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam iste dolor accusantium facere corporis ipsum animi deleniti fugiat. Ex, veniam?</p>
            <p><a href="#" class="btn btn-primary btn-sm">Shop Now</a></p>
          </div>
        </div>
      </div>
    </div>
@endsection