@extends('frontend.layout.main')

@section('content')
    <section class="page-hero">
      <div class="container-wide text-center">
        <div class="badge-level bg-white/10 text-white mb-3">Mission & Vision</div>
        <h1>Connecting Farmers with Opportunity, Support, and Growth.</h1>
        <p class="mx-auto text-white/85" style="max-width: 760px;">Our mission is to make quality agricultural products and services accessible, trustworthy, and affordable for farmers while building a scalable rural network grounded in technology and local support.</p>
      </div>
    </section>

    <main>
      <section class="section">
        <div class="container-wide">
          <div class="row g-5 align-items-center">
            <div class="col-lg-6">
              <img src="{{ url('frontend/assets/bhu-agri-network.svg') }}" alt="Farmer field support network" class="img-fluid rounded-4 shadow-lg" />
            </div>
            <div class="col-lg-6 content-rich">
              <div class="badge-level mb-3">Our Mission</div>
              <h2>To make quality agricultural products, services, technology and support accessible for every farmer.</h2>
              <p>BhuSanchar exists to strengthen the agricultural ecosystem by connecting farmers with reliable inputs, better information, technology and local support. We believe access to the right products and the right guidance can directly improve productivity and confidence in farming.</p>
              <p>Our mission is to connect farmers with trusted agricultural resources, support local distribution, enable better soil and farm decisions, and create opportunities for rural entrepreneurs and agricultural professionals.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="section section-soft">
        <div class="container-wide">
          <div class="text-center mb-5">
            <div class="badge-level mb-3">Our Vision</div>
            <h2 class="section-title">To build India's most connected and farmer-centric AgriTech network.</h2>
            <p class="section-subtitle mx-auto">We envision a future where every farmer can access quality products, local stock points, soil testing, agricultural support, logistics, technology and eligible benefits through one connected network.</p>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-3">
              <div class="metric-box">
                <span class="metric">Quality Products</span>
                <p class="mb-0">Trusted agricultural inputs across key crop and seasonal needs.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="metric-box">
                <span class="metric">Local Stock Points</span>
                <p class="mb-0">Closer access for farmers through block, panchayat and village networks.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="metric-box">
                <span class="metric">Soil Testing</span>
                <p class="mb-0">Practical support for informed crop and soil management.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="metric-box">
                <span class="metric">Farmer Benefits</span>
                <p class="mb-0">Savings, schemes and support that make agriculture more resilient.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="container-wide">
          <div class="text-center mb-5">
            <div class="badge-level mb-3">Our Belief</div>
            <h2 class="section-title">When farmers have better access, better information and better support, agriculture becomes stronger.</h2>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Connect farmers with reliable resources</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Strengthen local agricultural distribution</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Support better soil and farm decisions</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Enable technology at grassroots level</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Create rural entrepreneurship opportunities</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Build a transparent and scalable ecosystem</h4></div></div>
          </div>
        </div>
      </section>
    </main>
@endsection
