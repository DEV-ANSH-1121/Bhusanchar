<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-wide d-flex flex-wrap align-items-center justify-content-between w-100">
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ url('frontend/media/logo-cropped.png') }}" alt="BhuSanchar Logo" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><a class="nav-link @if(request()->routeIs('home')) active @endif" href="{{ route('home') }}">Home</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @if(request()->routeIs('about.*')) active @endif" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              About
            </a>
            <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
              <li><a class="dropdown-item @if(request()->routeIs('about.index')) active @endif" href="{{ route('about.index') }}">About Bhusanchar</a></li>
              <li><a class="dropdown-item @if(request()->routeIs('about.mission')) active @endif" href="{{ route('about.mission') }}">Mission and Vision</a></li>
              <li><a class="dropdown-item @if(request()->routeIs('about.team')) active @endif" href="{{ route('about.team') }}">Our Team</a></li>
              <li><a class="dropdown-item @if(request()->routeIs('about.investor')) active @endif" href="{{ route('about.investor') }}">Investor</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link @if(request()->routeIs('products')) active @endif" href="{{ route('products') }}">Products</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @if(request()->routeIs('services.*')) active @endif" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Services
            </a>
            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
              <li><a class="dropdown-item @if(request()->routeIs('services.index')) active @endif" href="{{ route('services.index') }}#services-overview">All Services</a></li>
              <li><a class="dropdown-item @if(request()->routeIs('services.farmer-help-card')) active @endif" href="{{ route('services.farmer-help-card') }}">Farmer Help Card</a></li>
              <li><a class="dropdown-item @if(request()->routeIs('services.find-stock-point')) active @endif" href="{{ route('services.find-stock-point') }}">Find Stock Point</a></li>
              <li><a class="dropdown-item @if(request()->routeIs('services.network')) active @endif" href="{{ route('services.network') }}">Our Network</a></li>
              <li><a class="dropdown-item @if(request()->routeIs('services.knowledge')) active @endif" href="{{ route('services.knowledge') }}">Knowledge Center</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @if(request()->routeIs('resource.*')) active @endif" href="#" id="resourceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Resource
            </a>
            <ul class="dropdown-menu" aria-labelledby="resourceDropdown">
              <li><a class="dropdown-item" href="#">Life at Bhusanchar</a></li>
              <li><a class="dropdown-item" href="#">Blog</a></li>
              <li><a class="dropdown-item @if(request()->routeIs('resource.gallery')) active @endif" href="{{ route('resource.gallery') }}">Gallery</a></li>
              <li><a class="dropdown-item" href="#">Press</a></li>
              <li><a class="dropdown-item" href="#">Krishi Gyan</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link @if(request()->routeIs('careers')) active @endif" href="{{ route('careers') }}">Careers</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @if(request()->routeIs('partner.*')) active @endif" href="#" id="partnerDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Partner With Us
            </a>
            <ul class="dropdown-menu" aria-labelledby="partnerDropdown">
              <li><a class="dropdown-item @if(request()->routeIs('partner.index')) active @endif" href="{{ route('partner.index') }}">Partner With Us</a></li>
              <li><a class="dropdown-item" href="#">Block Stock Point</a></li>
              <li><a class="dropdown-item" href="#">Panchayat Stock Point</a></li>
              <li><a class="dropdown-item" href="#">Last Mile Delivery</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link @if(request()->routeIs('contact')) active @endif" href="{{ route('contact') }}">Contact</a></li>
        </ul>
        <a href="{{ route('services.farmer-help-card') }}" class="btn btn-primary-custom">Get Farmer Help Card</a>
      </div>
    </div>
  </nav>
