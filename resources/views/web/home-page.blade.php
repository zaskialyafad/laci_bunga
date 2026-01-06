@extends('layout.template-page')
@section('content')
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
{{-- billboard --}}
 <section id="billboard" class="bg-light py-5">
    <div class="container">
      <div class="row justify-content-center">
        <h1 class="section-title text-center mt-4" data-aos="fade-up">New Collections</h1>
        <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
          <p>Seakan membuka laci kayu tua yang menyimpan aroma bunga kering dan surat cinta masa lalu, koleksi terbaru Laci Bunga hadir untuk menyapa jiwa nostalgiamu.</p>
        </div>
      </div>
      {{-- Swiper --}}
      <div class="row">        
        <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600">
          <div class="swiper-wrapper d-flex border-animation-left">
            {{-- Banner Item  --}}
            @foreach ($produkBanner->take(6) as $product )
            <div class="swiper-slide">
              <div class="banner-item image-zoom-effect">
                <div class="image-holder">
                  <a href="{{route ('web.detail-produk', $product->id) }}">
                    @if($product->gambar_produk->count()> 0)
                        <img src="{{asset('storage/productsImg/' . $product->gambar_produk->first()->image)}}" alt="product" style="width: 100%; height: 500px; object-fit: cover; object-position: center;">
                    @else
                        <img src="{{ asset('assets/img/no-image.png') }}" alt="">
                    @endif
                  </a>
                </div>
                <div class="banner-content py-4">
                  <h5 class="element-title text-uppercase">
                    <a href="{{ route('web.detail-produk', $product->id) }}" class="item-anchor">{{ $product->product_name }}</a>
                  </h5>
                  <p>{{ Str::limit($product->description, 80) }}</p>
                  <div class="btn-left">
                    <a href="{{ route('web.detail-produk', $product->id) }}" class="btn-link fs-6 text-uppercase item-anchor text-decoration-none">Discover Now</a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>
        <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
            <use xlink:href="#arrow-left"></use>
          </svg></div>
        <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
            <use xlink:href="#arrow-right"></use>
          </svg></div>
      </div>
    </div>
  </section>

  {{-- Fitur --}}
  <section class="features py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="0">
          <div class="py-5">
            <svg width="38" height="38" viewBox="0 0 24 24">
              <use xlink:href="#calendar"></use>
            </svg>
            <h4 class="element-title text-capitalize my-3">Bahan Pilihan</h4>
            <p>Menggunakan katun organik dan linen berkualitas tinggi yang sejuk serta nyaman untuk kulit sensitif.</p>
          </div>
        </div>
        <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="300">
          <div class="py-5">
            <svg width="38" height="38" viewBox="0 0 24 24">
              <use xlink:href="#shopping-bag"></use>
            </svg>
            <h4 class="element-title text-capitalize my-3">Detail Estetik</h4>
            <p>Setiap koleksi dipercantik dengan sentuhan bordir tangan dan renda vintage yang memberikan kesan klasik.</p>
          </div>
        </div>
        <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="600">
          <div class="py-5">
            <svg width="38" height="38" viewBox="0 0 24 24">
              <use xlink:href="#gift"></use>
            </svg>
            <h4 class="element-title text-capitalize my-3">Kemasan Cantik</h4>
            <p>Setiap produk dikemas rapi dengan sentuhan estetik, sangat cocok untuk dijadikan kado spesial.</p>
          </div>
        </div>
        <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="900">
          <div class="py-5">
            <svg width="38" height="38" viewBox="0 0 24 24">
              <use xlink:href="#arrow-cycle"></use>
            </svg>
            <h4 class="element-title text-capitalize my-3">Nyaman Dipakai</h4>
            <p>Tersedia dalam berbagai ukuran, mulai dari S hingga XL dengan potongan yang menyesuaikan bentuk tubuh.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Kategori --}}
  <section class="categories overflow-hidden">
    <div class="container">
      <div class="open-up" data-aos="zoom-out">
        <div class="row">
          <div class="col-md-3">
            <div class="cat-item image-zoom-effect">
              <div class="image-holder">
                <a href="{{ route('web.all-produk', ['category' => 3]) }}">
                  <img src="{{ asset('/') }}assets/img/page/cat-item1.png" alt="categories" class="product-image img-fluid">
                </a>
              </div>
              <div class="category-content">
                <div class="product-button">
                  <a href="{{ route('web.all-produk', ['category' => 3]) }}" class="btn btn-common text-uppercase">Top</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="cat-item image-zoom-effect">
              <div class="image-holder">
                <a href="{{ route('web.all-produk', ['category' => 4]) }}">
                  <img src="{{ asset('/') }}assets/img/page/cat-item2.png" alt="categories" class="product-image img-fluid">
                </a>
              </div>
              <div class="category-content">
                <div class="product-button">
                  <a href="{{ route('web.all-produk', ['category' => 4]) }}" class="btn btn-common text-uppercase">Bottom</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="cat-item image-zoom-effect">
              <div class="image-holder">
                <a href="{{ route('web.all-produk', ['category' => 1]) }}">
                  <img src="{{ asset('/') }}assets/img/page/cat-item3.png" alt="categories" class="product-image img-fluid">
                </a>
              </div>
              <div class="category-content">
                <div class="product-button">
                  <a href="{{ route('web.all-produk', ['category' => 1]) }}" class="btn btn-common text-uppercase">Dress</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="cat-item image-zoom-effect">
              <div class="image-holder">
                <a href="{{ route('web.all-produk', ['category' => 5]) }}">
                  <img src="{{ asset('/') }}assets/img/page/cat-item4.png" alt="categories" class="product-image img-fluid">
                </a>
              </div>
              <div class="category-content">
                <div class="product-button">
                  <a href="{{ route('web.all-produk', ['category' => 5]) }}" class="btn btn-common text-uppercase">Accessories</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- new arrival --}}
  <section id="new-arrival" class="new-arrival product-carousel py-5 position-relative overflow-hidden">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
        <h4 class="text-uppercase">Our New Arrivals</h4>
        <a href="{{ route('web.all-produk') }}" class="btn-link">View All Products</a>
      </div>
      <div class="swiper product-swiper open-up" data-aos="zoom-out">
        <div class="swiper-wrapper d-flex">
          {{-- swiper produk --}}
          @foreach ($newArrivals as $product )
          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative" >
                <a href="{{ route('web.detail-produk', $product->id) }}">
                  @if ($product->gambar_produk->count()>0)
                    <img style="width: 100%; height: 300px; object-fit: cover; object-position: center;" src="{{asset('storage/productsImg/' . $product->gambar_produk->first()->image)}}" alt="{{ $product->product_name }}"  class="product-image">
                  @else
                    <img src="{{ asset('assets/img/no-image.png') }}" alt="{{ $product->product_name }}" class="product-image img-fluid">
                  @endif
                </a>
                <div class="btn-wishlist-container position-absolute top-0 end-0 m-3" style="z-index: 5;">
                    <form action="{{ route('wishlist.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        @php
                            $isFavorit = false;
                            if(auth()->check()) {
                                $isFavorit = \App\Models\Wishlist::where('user_id', auth()->id())
                                            ->where('product_id', $product->id)
                                            ->exists();
                            }
                        @endphp

                        <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" style="width: 35px; height: 35px; border: none;">
                            @if($isFavorit)
                                <i class="fas fa-heart text-danger"></i>
                            @else
                                <i class="far fa-heart"></i> 
                            @endif
                        </button>
                    </form>
                </div>
                <div class="product-content">
                  <h5 class="element-title text-uppercase fs-5 mt-3">
                    <a href="{{ route('web.detail-produk', $product->id) }}">
                      {{ $product->product_name }}
                    </a>
                  </h5>
                  @if ($product->product_variation->count()>0)
                    @php
                      $hargaMin = $product->product_variation->min('price');
                      $hargaMax = $product->product_variation->max('price');
                    @endphp
                  @endif
                  <a href="{{ route('web.detail-produk', $product->id) }}" class="text-decoration-none" data-after="Add to cart">
                    @if ($hargaMin == $hargaMax)
                     <span>Rp {{ number_format($hargaMin, 0, ',', '.') }}</span>
                    @else
                      <span>Rp {{ number_format($hargaMin, 0, ',', '.') }} - Rp {{ number_format($hargaMax, 0, ',', '.') }}</span>
                    @endif
                  </a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="swiper-pagination"></div>
      </div>
      <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
          <use xlink:href="#arrow-left"></use>
        </svg></div>
      <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
          <use xlink:href="#arrow-right"></use>
        </svg></div>
    </div>
  </section>

  {{-- best seller --}}
  <section id="best-sellers" class="best-sellers product-carousel py-5 position-relative overflow-hidden">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
        <h4 class="text-uppercase">Best Selling Items</h4>
        <a href="{{ route('web.all-produk') }}" class="btn-link">View All Products</a>
      </div>
      <div class="swiper product-swiper open-up" data-aos="zoom-out">
        <div class="swiper-wrapper d-flex">
          {{-- swiper produk --}}
          @foreach ($newArrivals as $product )
          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="{{ route('web.detail-produk', $product->id) }}">
                  @if ($product->gambar_produk->count()>0)
                    <img style="width: 100%; height: 300px; object-fit: cover; object-position: center;" src="{{asset('storage/productsImg/' . $product->gambar_produk->first()->image)}}" alt="{{ $product->product_name }}"  class="product-image">
                  @else
                    <img src="{{ asset('assets/img/no-image.png') }}" alt="{{ $product->product_name }}" class="product-image img-fluid">
                  @endif
                </a>
                <div class="btn-wishlist-container position-absolute top-0 end-0 m-3" style="z-index: 5;">
                    <form action="{{ route('wishlist.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        @php
                            $isFavorit = false;
                            if(auth()->check()) {
                                $isFavorit = \App\Models\Wishlist::where('user_id', auth()->id())
                                            ->where('product_id', $product->id)
                                            ->exists();
                            }
                        @endphp

                        <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" style="width: 35px; height: 35px; border: none;">
                            @if($isFavorit)
                                <i class="fas fa-heart text-danger"></i> {{-- Hati Merah --}}
                            @else
                                <i class="far fa-heart"></i> {{-- Hati Kosong --}}
                            @endif
                        </button>
                    </form>
                </div>                
                <div class="product-content">
                  <h5 class="element-title text-uppercase fs-5 mt-3">
                    <a href="{{ route('web.detail-produk', $product->id) }}">
                      {{ $product->product_name }}
                    </a>
                  </h5>
                  @if ($product->product_variation->count()>0)
                    @php
                      $hargaMin = $product->product_variation->min('price');
                      $hargaMax = $product->product_variation->max('price');
                    @endphp
                  @endif
                  <a href="{{ route('web.detail-produk', $product->id) }}" class="text-decoration-none" data-after="Add to cart">
                    @if ($hargaMin == $hargaMax)
                     <span>Rp {{ number_format($hargaMin, 0, ',', '.') }}</span>
                    @else
                      <span>Rp {{ number_format($hargaMin, 0, ',', '.') }} - Rp {{ number_format($hargaMax, 0, ',', '.') }}</span>
                    @endif
                  </a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="swiper-pagination"></div>
      </div>
      <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
          <use xlink:href="#arrow-left"></use>
        </svg></div>
      <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
          <use xlink:href="#arrow-right"></use>
        </svg></div>
    </div>
  </section>

  {{-- testimoni --}}
  <section class="testimonials py-5 bg-light">
      <div class="section-header text-center mt-5">
          <h3 class="section-title">APA KATA MEREKA?</h3>
      </div>
      <div class="swiper testimonial-swiper overflow-hidden my-5">
          <div class="swiper-wrapper d-flex">
              <div class="swiper-slide">
                  <div class="testimonial-item text-center">
                      <blockquote>
                          <p>“Bahannya benar-benar adem, linennya premium dan tidak gatal di kulit. Sangat nyaman dipakai seharian untuk acara outdoor.”</p>
                          <div class="review-title text-uppercase">Riana Putri</div>
                      </blockquote>
                  </div>
              </div>

              <div class="swiper-slide">
                  <div class="testimonial-item text-center">
                      <blockquote>
                          <p>“Detail bordir dan rendanya sangat cantik dan rapi, jarang banget nemu kualitas jahitan tangan yang se-estetik ini dengan harga terjangkau.”</p>
                          <div class="review-title text-uppercase">Saraswati</div>
                      </blockquote>
                  </div>
              </div>

              <div class="swiper-slide">
                  <div class="testimonial-item text-center">
                      <blockquote>
                          <p>“Suka banget sama potongannya! Walaupun badanku agak berisi, ukuran L/XL-nya pas banget dan bikin kelihatan lebih jenjang.”</p>
                          <div class="review-title text-uppercase">Amalia</div>
                      </blockquote>
                  </div>
              </div>

              <div class="swiper-slide">
                  <div class="testimonial-item text-center">
                      <blockquote>
                          <p>“Packaging-nya sangat estetik, cocok buat kado. Koleksi cottagecore-nya bener-bener unik dan beda dari brand lain.”</p>
                          <div class="review-title text-uppercase">Dewi Lestari</div>
                      </blockquote>
                  </div>
              </div>
          </div>
      </div>
      <div class="testimonial-swiper-pagination d-flex justify-content-center mb-5"></div>
  </section>

  {{-- related product --}}
  <section id="related-products" class="related-products product-carousel py-5 position-relative overflow-hidden">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
        <h4 class="text-uppercase">You May Also Like</h4>
        <a href="{{ route('web.all-produk') }}" class="btn-link">View All Products</a>
      </div>
      <div class="swiper product-swiper open-up" data-aos="zoom-out">
        <div class="swiper-wrapper d-flex">
          {{-- swiper produk --}}
          @foreach ($relatedProducts as $product )
          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="{{ route('web.detail-produk', $product->id) }}">
                  @if ($product->gambar_produk->count()>0)
                    <img style="width: 100%; height: 300px; object-fit: cover; object-position: center;" src="{{asset('storage/productsImg/' . $product->gambar_produk->first()->image)}}" alt="{{ $product->product_name }}"  class="product-image">
                  @else
                    <img src="{{ asset('assets/img/no-image.png') }}" alt="{{ $product->product_name }}" class="product-image img-fluid">
                  @endif
                </a>
                <div class="btn-wishlist-container position-absolute top-0 end-0 m-3" style="z-index: 5;">
                    <form action="{{ route('wishlist.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        @php
                            $isFavorit = false;
                            if(auth()->check()) {
                                $isFavorit = \App\Models\Wishlist::where('user_id', auth()->id())
                                            ->where('product_id', $product->id)
                                            ->exists();
                            }
                        @endphp

                        <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" style="width: 35px; height: 35px; border: none;">
                            @if($isFavorit)
                                <i class="fas fa-heart text-danger"></i> {{-- Hati Merah --}}
                            @else
                                <i class="far fa-heart"></i> {{-- Hati Kosong --}}
                            @endif
                        </button>
                    </form>
                </div>
                <div class="product-content">
                  <h5 class="element-title text-uppercase fs-5 mt-3">
                    <a href="{{ route('web.detail-produk', $product->id) }}">
                      {{ $product->product_name }}
                    </a>
                  </h5>
                  @if ($product->product_variation->count()>0)
                    @php
                      $hargaMin = $product->product_variation->min('price');
                      $hargaMax = $product->product_variation->max('price');
                    @endphp
                  @endif
                  <a href="{{ route('web.detail-produk', $product->id) }}" class="text-decoration-none" data-after="Add to cart">
                    @if ($hargaMin == $hargaMax)
                     <span>Rp {{ number_format($hargaMin, 0, ',', '.') }}</span>
                    @else
                      <span>Rp {{ number_format($hargaMin, 0, ',', '.') }} - Rp {{ number_format($hargaMax, 0, ',', '.') }}</span>
                    @endif
                  </a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="swiper-pagination"></div>
      </div>
      <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
          <use xlink:href="#arrow-left"></use>
        </svg></div>
      <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
          <use xlink:href="#arrow-right"></use>
        </svg></div>
    </div>
  </section>

  {{-- instagram --}}
  <section class="instagram position-relative">
    <div class="d-flex justify-content-center w-100 position-absolute bottom-0 z-1">
      <a href="https://www.instagram.com/alyayazask_/" class="btn btn-dark px-5">Follow us on Instagram</a>
    </div>
    <div class="row g-0">
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/alyayazask_/" target="_blank">
            <img src="{{ asset('/') }}assets/img/page/insta-item1.jpg" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/alyayazask_/" target="_blank">
            <img src="{{ asset('/') }}assets/img/page/insta-item2.jpg" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/alyayazask_/" target="_blank">
            <img src="{{ asset('/') }}assets/img/page/insta-item3.jpg" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/alyayazask_/" target="_blank">
            <img src="{{ asset('/') }}assets/img/page/insta-item4.jpg" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/alyayazask_/" target="_blank">
            <img src="{{ asset('/') }}assets/img/page/insta-item5.jpg" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <div class="insta-item">
          <a href="https://www.instagram.com/alyayazask_/" target="_blank">
            <img src="{{ asset('/') }}assets/img/page/insta-item6.jpg" alt="instagram" class="insta-image img-fluid">
          </a>
        </div>
      </div>
    </div>
  </section>
@endsection