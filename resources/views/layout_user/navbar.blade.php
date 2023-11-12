<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
        <h1>Yummy<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#hero">Home</a></li>    
          <li><a href="#menu">Menu</a></li>
        </ul>
      </nav><!-- .navbar -->
      <form action="{{route('logout')}}" method="post">
                            @csrf
                        <button class="btn-book-a-table" href="" type="submit">
                            <span class="profile-icon fa-solid fa-right-from-bracket"></span>
                            <div class="fs-12">Logout</div>
</button>
                        </form>
      <!-- <a class="btn-book-a-table" href="#logout">Logout</a> -->
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->