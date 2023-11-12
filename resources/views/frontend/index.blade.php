@extends('layout_user.dashboard')
@section('body')


<!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center section-bg">
        <div class="container">
        <div class="row justify-content-between gy-5">
            <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
            <h2 data-aos="fade-up">Enjoy Your Healthy<br>Delicious Food</h2>
            <p data-aos="fade-up" data-aos-delay="100">Sed autem laudantium dolores. Voluptatem itaque ea consequatur eveniet. Eum quas beatae cumque eum quaerat.</p>
            <!-- <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                <a href="#book-a-table" class="btn-book-a-table">Book a Table</a>
                <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div> -->
</div> <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start"> <img src="assets/img/hero-img.png"
  class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
</div> </div> </div>
</section><!-- End Hero Section --> <!--=======Menu Section=======--> <section id="menu" class="menu"> <div
  class="container" data-aos="fade-up">

<div class="section-header">
  <h2>Our Menu</h2>
  <p>Check Our <span>Yummy Menu</span></p>
</div>

<ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">

  <li class="nav-item">
    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
      <h4>Starters</h4>
    </a>
  </li><!-- End tab nav item -->



</ul>

<div class="tab-content" data-aos="fade-up" data-aos-delay="300">

  <div class="tab-pane fade active show" id="menu-starters">

    <div class="tab-header text-center">
      <p>Menu</p>
      <h3>Starters</h3>
    </div>

    <div class="row gy-5">
      @foreach($products as $menuItem)
      <div class="col-lg-4 menu-item">
        <a href="{{ asset('assets/' . $menuItem['image']) }}" class="glightbox">
          <img src="{{ asset('assets/' . $menuItem['image']) }}" class="menu-img img-fluid" alt="">
        </a>

        <h4>{{ $menuItem['title'] }}</h4>
        <p class="ingredients">Lorem, deren, trataro, filede, nerada</p>
        <p class="price">{{ $menuItem['price'] }}</p>

        {{-- <form action="{{ route('comments', ['id' => $menuItem['id']]) }}" method="get">
          <button type="submit" class="btn btn-danger">Comments</button>
        </form> --}}


        <form action="{{ route('feedbacks', ['id' => $menuItem['id']]) }}" method="get">
          <button class="btn btn-danger">Feedbacks</button>
        </form>
        
      </div><!-- Menu Item -->
      @endforeach


    </div>
  </div>
</div><!-- End Starter Menu Content --><br />
@endsection