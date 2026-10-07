@extends('frontend.layout.main')

@section('content')
    <section class="page-hero">
      <div class="container-wide text-center">
        <div class="badge-level bg-white/10 text-white mb-3">About BhuSanchar</div>
        <h1>Agriculture Is Our Foundation. Farmers Are Our Priority.</h1>
        <p class="mx-auto text-white/85" style="max-width: 760px;">We believe farmers need more than products — they need access, information, quality, technology, support and affordability delivered through a network designed for rural India.</p>
      </div>
    </section>

    <main>
      <section class="section">
        <div class="container-wide">
          <div class="row g-5 align-items-center">
            <div class="col-lg-6">
              <img src="{{ url('frontend/assets/bhu-agri-network.svg') }}" alt="Agriculture and farmers network" class="img-fluid rounded-4 shadow-lg" />
            </div>
            <div class="col-lg-6 content-rich">
              <h2>Why We Started</h2>
              <p>BhuSanchar was started with the belief that farmers need more than agricultural products. They need access, information, quality, technology and local support in a system that is built around their realities.</p>
              <p>Across India, farmers often face fragmented access to trusted inputs, soil guidance, scheme information, local stock points and dependable logistics. BhuSanchar was built to address these challenges and create a more connected, digital and farmer-first agricultural ecosystem.</p>
              <p>Our mission is to combine product access with service delivery, digital support and rural empowerment so agriculture becomes more efficient, transparent and affordable.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="section section-soft">
        <div class="container-wide">
          <div class="text-center mb-5">
            <div class="badge-level mb-3">Our Vision</div>
            <h2 class="section-title">Building India's Connected Agricultural Network</h2>
            <p class="section-subtitle mx-auto">To create a trusted, technology-enabled agricultural network connecting farmers with products, services, knowledge and opportunities across India.</p>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-3">
              <div class="metric-box">
                <span class="metric">Access</span>
                <p class="mb-0">Product availability through local stock points</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="metric-box">
                <span class="metric">Information</span>
                <p class="mb-0">Soil guidance, schemes and agronomic knowledge</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="metric-box">
                <span class="metric">Technology</span>
                <p class="mb-0">Digital tools and verification for rural stakeholders</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="metric-box">
                <span class="metric">Growth</span>
                <p class="mb-0">Empowering farmers, entrepreneurs and communities</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="container-wide">
          <div class="text-center mb-5">
            <div class="badge-level mb-3">Our Mission</div>
            <h2 class="section-title">How we create impact</h2>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-3">
              <div class="card-modern">
                <h4>Make agricultural products accessible</h4>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="card-modern">
                <h4>Build local agricultural infrastructure</h4>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="card-modern">
                <h4>Support soil health</h4>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="card-modern">
                <h4>Provide farmer assistance</h4>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="card-modern">
                <h4>Improve distribution</h4>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="card-modern">
                <h4>Support government-scheme awareness</h4>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="card-modern">
                <h4>Create rural employment</h4>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="card-modern">
                <h4>Empower rural entrepreneurs</h4>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section section-soft">
        <div class="container-wide">
          <div class="text-center mb-5">
            <div class="badge-level mb-3">Our Values</div>
            <h2 class="section-title">Principles that guide every decision</h2>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Farmer First</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Quality First</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Transparency</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Technology With Purpose</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Local Accessibility</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Rural Empowerment</h4></div></div>
            <div class="col-md-6 col-lg-4 offset-lg-4"><div class="card-modern"><h4>Responsible Growth</h4></div></div>
          </div>
        </div>
      </section>
    </main>
@endsection
