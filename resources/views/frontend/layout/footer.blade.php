<footer class="site-footer">
    <div class="container-wide">
      <div class="row g-5">
        <div class="col-lg-4">
          <img src="{{ url('frontend/media/logo-cropped.png') }}" alt="BhuSanchar logo" class="logo-compact mb-3" />
          <h5 class="mb-3">BhuSanchar</h5>
          <p>Empowering Farmers. Strengthening Agriculture. Connecting Rural India.</p>
        </div>
        <div class="col-lg-2 col-md-4">
          <h5>Company</h5>
          <ul class="list-unstyled d-grid gap-2">
            <li><a href="{{ route('about.index') }}">About BhuSanchar</a></li>
            <li><a href="{{ route('about.mission') }}">Mission &amp; Vision</a></li>
            <li><a href="{{ route('about.team') }}">Our Team</a></li>
            <li><a href="{{ route('about.investor') }}">Investor</a></li>
            <li><a href="{{ route('services.network') }}">Network</a></li>
            <li><a href="{{ route('careers') }}">Careers</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-4">
          <h5>Farmer</h5>
          <ul class="list-unstyled d-grid gap-2">
            <li><a href="{{ route('contact') }}">Farmer Registration</a></li>
            <li><a href="{{ route('services.farmer-help-card') }}">Farmer Help Card</a></li>
            <li><a href="{{ route('services.index') }}">Soil Testing</a></li>
            <li><a href="{{ route('services.find-stock-point') }}">Find Stock Point</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-4">
          <h5>Business</h5>
          <ul class="list-unstyled d-grid gap-2">
            <li><a href="{{ route('products') }}">Products</a></li>
            <li><a href="{{ route('partner.index') }}">Become a Partner</a></li>
            <li><a href="{{ route('services.network') }}">Stock Points</a></li>
            <li><a href="{{ route('services.index') }}">Logistics</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-4">
          <h5>Knowledge</h5>
          <ul class="list-unstyled d-grid gap-2">
            <li><a href="{{ route('services.knowledge') }}">Krishi Gyan Kendra</a></li>
            <li><a href="{{ route('resource.gallery') }}">Resource</a></li>
            <li><a href="{{ route('about.index') }}">Farmer Stories</a></li>
            <li><a href="{{ route('services.index') }}">Agriculture Resources</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-5">
        <small>&copy; <span id="year"></span> BhuSanchar. All rights reserved.</small>
        <div class="d-flex gap-3 flex-wrap">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms & Conditions</a>
          <a href="#">Disclaimer</a>
        </div>
      </div>
    </div>
  </footer>
