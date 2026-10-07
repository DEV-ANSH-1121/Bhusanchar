@extends('frontend.layout.main')

@section('content')
    <section class="page-hero">
      <div class="container-wide text-center">
        <div class="badge-level bg-white/10 text-white mb-3">Investor</div>
        <h1>Building the Next Agricultural Network of India.</h1>
        <p class="mx-auto text-white/85" style="max-width: 760px;">BhuSanchar is developing a scalable model around products, distribution, technology and a growing rural network that reaches farmers where they need support the most.</p>
      </div>
    </section>

    <main>
      <section class="section">
        <div class="container-wide">
          <div class="row g-5 align-items-center">
            <div class="col-lg-6">
              <img src="{{ url('frontend/assets/bhu-agri-network.svg') }}" alt="Investment and agricultural ecosystem" class="img-fluid rounded-4 shadow-lg" />
            </div>
            <div class="col-lg-6 content-rich">
              <div class="badge-level mb-3">Investment Opportunity</div>
              <h2>Products + Distribution + Technology + Farmer Network</h2>
              <p>The business is designed to expand through a growing network of stock points, district teams, block teams and panchayat-level outreach, supported by centralized technology and logistics.</p>
              <p>As rural demand grows, BhuSanchar aims to create a strong, scalable and transparent agricultural distribution ecosystem that connects farmers, local networks and agricultural services.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="section section-soft">
        <div class="container-wide">
          <div class="text-center mb-5">
            <div class="badge-level mb-3">Growth Areas</div>
            <h2 class="section-title">The opportunity is structural and long-term</h2>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Expansion of agricultural product distribution</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Block-level stock-point network</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Farmer acquisition and registration</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Farmer Help Card ecosystem</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Technology platform</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Logistics infrastructure</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Soil-testing services</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>Rural employment</h4></div></div>
            <div class="col-md-6 col-lg-4"><div class="card-modern"><h4>State and regional expansion</h4></div></div>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="container-wide">
          <div class="text-center mb-5">
            <div class="badge-level mb-3">Stakeholders</div>
            <h2 class="section-title">Creating value across the agricultural ecosystem</h2>
          </div>
          <div class="row g-4">
            <div class="col-md-4">
              <div class="card-modern">
                <h4>Farmers</h4>
                <p>Better access, support, information and eligible savings.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card-modern">
                <h4>Partners</h4>
                <p>Business opportunities, products, technology and local demand.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card-modern">
                <h4>Investors</h4>
                <p>A scalable AgriTech and rural-distribution network with long-term expansion potential.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection
