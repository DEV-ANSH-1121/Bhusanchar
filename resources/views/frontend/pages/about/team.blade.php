@extends('frontend.layout.main')

@section('content')
    <section class="page-hero">
      <div class="container-wide text-center">
        <div class="badge-level bg-white/10 text-white mb-3">Our Team</div>
        <h1>People working closely with farmers and rural communities.</h1>
        <p class="mx-auto text-white/85" style="max-width: 760px;">BhuSanchar is being built by a team that brings technology, business, agriculture, operations, distribution and rural-market capabilities together to create a farmer-first ecosystem.</p>
      </div>
    </section>

    <main>
      <section class="section">
        <div class="container-wide">
          <div class="text-center mb-5">
            <div class="badge-level mb-3">Our People</div>
            <h2 class="section-title">A network built from the field up</h2>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-4">
              <div class="card-modern">
                <h4>District Level</h4>
                <p>District officers and coordinators manage regional operations, network development and performance.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card-modern">
                <h4>Block Level</h4>
                <p>Block officers coordinate stock points, farmer engagement and local operations.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card-modern">
                <h4>Panchayat Level</h4>
                <p>Panchayat and field officers work directly with farmers and support grassroots activities.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card-modern">
                <h4>Agriculture & Soil</h4>
                <p>Agriculture professionals and soil-testing teams support farmers with practical field guidance.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card-modern">
                <h4>Sales & Distribution</h4>
                <p>Teams manage product reach, local relationships and demand generation across rural networks.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card-modern">
                <h4>Logistics & Operations</h4>
                <p>Operations teams ensure movement of products from source to stock point and farmer/customer.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 offset-lg-2">
              <div class="card-modern">
                <h4>Technology</h4>
                <p>Technology professionals develop the digital infrastructure connecting farmers, partners and the network.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card-modern">
                <h4>Corporate Team</h4>
                <p>Business, finance, HR, marketing and administration teams support the overall organization.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section section-soft">
        <div class="container-wide">
          <div class="row g-5 align-items-center">
            <div class="col-lg-6">
              <div class="badge-level mb-3">Founder</div>
              <h2>Vijay Kumar</h2>
              <p class="lead">Founder — BhuSanchar</p>
              <p>Vijay Kumar is building BhuSanchar with the vision of combining technology, agricultural distribution and grassroots farmer support into one scalable ecosystem.</p>
              <p>The objective is to create a business that doesn't simply distribute agricultural products, but builds a long-term network around farmers, local entrepreneurs and agricultural communities.</p>
            </div>
            <div class="col-lg-6">
              <img src="{{ url('frontend/assets/bhu-agri-network.svg') }}" alt="Leadership and team working together" class="img-fluid rounded-4 shadow-lg" />
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection
