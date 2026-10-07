@extends('frontend.layout.main')

@section('content')
    <section class="page-hero">
      <div class="container-wide">
        <div class="row align-items-center g-5">
          <div class="col-lg-7">
            <div class="badge-level bg-white/10 text-white mb-3">BhuSanchar — All Services</div>
            <h1>Agriculture, technology &amp; support — connected around the farmer.</h1>
            <p class="lead text-white-50 mb-0">Quality products, reliable information, local support, technology and opportunities to save, brought closer to every farmer.</p>
          </div>
          <div class="col-lg-5"><img src="{{ url('frontend/assets/services-ecosystem.png') }}" alt="BhuSanchar ecosystem connecting quality products, soil and support, local stock points and technology" class="services-hero-image rounded-4 shadow-lg" /></div>
        </div>
      </div>
    </section>
    <main>
      <section class="section" id="services-overview">
        <div class="container-wide">
          <div class="section-heading mb-5">
            <span class="badge-level">Our Services</span>
            <h2 class="section-title mt-3">One connected ecosystem for stronger agriculture.</h2>
            <p class="section-subtitle">BhuSanchar connects farmers with agricultural products, soil-testing support, local stock points, logistics, technology and agricultural knowledge.</p>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-4" id="products-service"><div class="service-card"><div class="step">01. Quality Agricultural Products</div><i class="fa-solid fa-seedling"></i><h4>Quality inputs, closer to every farmer.</h4><p class="text-muted">Explore composition, benefits, suitable crops, application, packaging, storage and applicable quality or registration information.</p><a href="{{ route('products') }}" class="text-green fw-bold">Explore Products <i class="fa-solid fa-arrow-right"></i></a></div></div>
            <div class="col-md-6 col-lg-4" id="farmer-help-service"><div class="service-card"><div class="step">02. Farmer Help Card</div><i class="fa-solid fa-id-card"></i><h4>One card. More benefits. More savings.</h4><p class="text-muted">Registered farmers can access digital ID, QR verification, soil-testing support, local stock points, seasonal offers and purchase history, with eligible savings of up to 25%–50%.</p><a href="{{ route('services.farmer-help-card') }}" class="text-green fw-bold">Get Farmer Help Card <i class="fa-solid fa-arrow-right"></i></a></div></div>
            <div class="col-md-6 col-lg-4" id="stock-point-service"><div class="service-card"><div class="step">03. Find Stock Point</div><i class="fa-solid fa-map-location-dot"></i><h4>Agricultural support, closer to you.</h4><p class="text-muted">Search by state, district, block, panchayat and village, or find a BhuSanchar point near you for products, services, directions and delivery availability.</p><a href="{{ route('services.find-stock-point') }}" class="text-green fw-bold">Find a Stock Point <i class="fa-solid fa-arrow-right"></i></a></div></div>
            <div class="col-md-6 col-lg-4" id="network-service"><div class="service-card"><div class="step">04. Our Network</div><i class="fa-solid fa-network-wired"></i><h4>From one block to every corner of India.</h4><p class="text-muted">A scalable structure connecting States and Union Territories, districts, blocks, panchayats, villages, stock points and farmers.</p><a href="{{ route('services.network') }}" class="text-green fw-bold">Explore Our Network <i class="fa-solid fa-arrow-right"></i></a></div></div>
            <div class="col-md-6 col-lg-4" id="soil-testing-service"><div class="service-card"><div class="step">05. Free Soil Testing</div><i class="fa-solid fa-flask-vial"></i><h4>Know your soil. Make better decisions.</h4><p class="text-muted">Farmer registration, soil-test request, sample collection, laboratory testing, soil report and farmer guidance, subject to program availability and applicable terms.</p><a href="{{ route('contact') }}" class="text-green fw-bold">Request Soil Test <i class="fa-solid fa-arrow-right"></i></a></div></div>
            <div class="col-md-6 col-lg-4" id="support-service"><div class="service-card"><div class="step">06. Farmer Support</div><i class="fa-solid fa-headset"></i><h4>Support that comes closer to the farmer.</h4><p class="text-muted">Get help with products, usage, soil testing, stock-point availability, Help Card, schemes, quality concerns, orders, deliveries and general assistance.</p><a href="{{ route('contact') }}" class="text-green fw-bold">Get Farmer Support <i class="fa-solid fa-arrow-right"></i></a></div></div>
            <div class="col-md-6 col-lg-4" id="schemes-service"><div class="service-card"><div class="step">07. Government Scheme Support</div><i class="fa-solid fa-landmark"></i><h4>Understand available opportunities.</h4><p class="text-muted">Explore scheme benefits, eligibility, documents, application processes and official government resources. Approval and disbursement remain with the relevant authority.</p><a href="{{ route('services.knowledge') }}" class="text-green fw-bold">Explore Government Schemes <i class="fa-solid fa-arrow-right"></i></a></div></div>
            <div class="col-md-6 col-lg-4" id="logistics-service"><div class="service-card"><div class="step">08. Agricultural Logistics</div><i class="fa-solid fa-truck"></i><h4>From source to block. From block to farmer.</h4><p class="text-muted">Product availability, inventory visibility, stock planning, transportation, block-level fulfilment and farmer or customer delivery coordination.</p></div></div>
            <div class="col-md-6 col-lg-4" id="technology-service"><div class="service-card"><div class="step">09. Technology Support</div><i class="fa-solid fa-mobile-screen-button"></i><h4>Smart agriculture needs smart technology.</h4><p class="text-muted">Farmer profiles, digital cards, soil reports, support requests, inventory, billing, reports, stock alerts and field-officer task management.</p></div></div>
            <div class="col-md-6 col-lg-4" id="knowledge-service"><div class="service-card"><div class="step">10. Knowledge Center</div><i class="fa-solid fa-book-open"></i><h4>BhuSanchar Krishi Gyan Kendra.</h4><p class="text-muted">Practical information on fertilizer, soil health, crop management, organic inputs, government schemes, agriculture technology, seasons and farmer stories.</p><a href="{{ route('services.knowledge') }}" class="text-green fw-bold">Explore Knowledge Center <i class="fa-solid fa-arrow-right"></i></a></div></div>
          </div>
        </div>
      </section>
      <section class="section section-soft">
        <div class="container-wide">
          <div class="row g-5 align-items-center">
            <div class="col-lg-7"><span class="badge-level">Why BhuSanchar?</span><h2 class="section-title mt-3">Agriculture is more than a product. It is a relationship.</h2><p class="section-subtitle">Our ecosystem is built around quality, accessibility, technology, affordability, support and scale—from individual blocks to a Pan-India agricultural network.</p></div>
            <div class="col-lg-5"><div class="discount-box"><h3>Join the BhuSanchar Network</h3><p class="mb-4">Register as a farmer, get eligible Help Card benefits, find a stock point or become a partner.</p><div class="d-flex flex-wrap gap-2"><a href="{{ route('contact') }}" class="btn btn-primary-custom">Register as Farmer</a><a href="{{ route('partner.index') }}" class="btn btn-outline-custom">Become a Partner</a></div></div></div>
          </div>
          <p class="small text-muted mt-5 mb-0">*Discounts may vary by product, category, campaign, location, availability and applicable terms. The BhuSanchar Farmer Help Card is a BhuSanchar farmer-benefit program and is not a government-issued card.</p>
        </div>
      </section>
    </main>
@endsection
