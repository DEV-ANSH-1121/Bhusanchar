@extends('frontend.layout.main')

@section('content')
<header class="hero">
    <div class="container-wide hero-inner">
      <div class="row align-items-center g-5">
        <div class="col-lg-7">
          <div class="badge-level mb-4">Technology-enabled Agri Ecosystem</div>
          <h1>Empowering Farmers. Strengthening Agriculture. Connecting Rural India.</h1>
          <p class="mt-4 mb-5">BhuSanchar is building a technology-enabled agricultural ecosystem that brings quality agricultural products, soil testing, farmer support, logistics, technology and savings closer to farmers across India.</p>
          <div class="hero-cta d-flex flex-wrap">
            <a href="{{ route('services.find-stock-point') }}" class="btn btn-primary-custom">Find Stock Point</a>
            <a href="{{ route('services.farmer-help-card') }}" class="btn btn-outline-custom text-green border-white">Get Farmer Help Card</a>
            <a href="{{ route('contact') }}" class="btn btn-outline-custom text-green border-white">Register as Farmer</a>
            <a href="{{ route('partner.index') }}" class="btn btn-outline-custom text-green border-white">Become a Partner</a>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card-modern bg-white/5 border-white/10 text-white">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <span class="badge-level bg-white/10 text-white">Quick Access</span>
              <span class="text-warning"><i class="fa-solid fa-circle-check"></i> Verified Network</span>
            </div>
            <div class="mb-4">
              <h4 class="fw-bold text-white">Farmer Network Snapshot</h4>
              <p class="text-white/80 mb-0">Connecting states, districts, blocks, panchayats and villages with local support and trusted stock points.</p>
            </div>
            <div class="row g-3 text-white">
              <div class="col-6">
                <div class="bg-white/5 rounded-4 p-3">
                  <div class="fw-bold fs-3">18+</div>
                  <small>States active</small>
                </div>
              </div>
              <div class="col-6">
                <div class="bg-white/5 rounded-4 p-3">
                  <div class="fw-bold fs-3">500+</div>
                  <small>Stock points</small>
                </div>
              </div>
              <div class="col-6">
                <div class="bg-white/5 rounded-4 p-3">
                  <div class="fw-bold fs-3">20k+</div>
                  <small>Farmers served</small>
                </div>
              </div>
              <div class="col-6">
                <div class="bg-white/5 rounded-4 p-3">
                  <div class="fw-bold fs-3">3k+</div>
                  <small>Soil tests</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main>
    <section class="section pt-0">
      <div class="container-wide">
        <div class="value-strip row g-0">
          <div class="col-lg-2 col-md-4 col-sm-6 value-item">
            <i class="fa-solid fa-seedling"></i>
            <h5>Quality Products</h5>
            <p>Agricultural inputs with clear product information.</p>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 value-item">
            <i class="fa-solid fa-flask-vial"></i>
            <h5>Soil Testing</h5>
            <p>Understand soil health and crop suitability.</p>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 value-item">
            <i class="fa-solid fa-headset"></i>
            <h5>Farmer Support</h5>
            <p>Local guidance and agricultural assistance.</p>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 value-item">
            <i class="fa-solid fa-truck-fast"></i>
            <h5>Reliable Logistics</h5>
            <p>Efficient source-to-block-to-farmer distribution.</p>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 value-item">
            <i class="fa-solid fa-microchip"></i>
            <h5>Smart Technology</h5>
            <p>Digital tools for farmers, officers and partners.</p>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 value-item">
            <i class="fa-solid fa-users-rays"></i>
            <h5>Rural Empowerment</h5>
            <p>Creating local opportunities and entrepreneurship.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container-wide">
        <div class="row align-items-center g-5">
          <div class="col-lg-6">
            <div class="position-relative">
              <img src="https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=1200&q=80" alt="Farmer at field" class="img-fluid rounded-4 shadow-lg" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="badge-level mb-3">About BhuSanchar</div>
            <h2 class="section-title">Agriculture Is Our Foundation. Farmers Are Our Priority.</h2>
            <p class="section-subtitle mb-4">BhuSanchar is building a connected agricultural ecosystem that combines agricultural products, farmer services, technology, logistics and local distribution to make agriculture more accessible and affordable.</p>
            <ul class="list-unstyled mt-4 mb-5">
              <li class="mb-3"><i class="fa-solid fa-circle-check text-green me-2"></i> Trusted products, local availability and farmer support</li>
              <li class="mb-3"><i class="fa-solid fa-circle-check text-green me-2"></i> Digital tools built for rural India and agricultural communities</li>
              <li class="mb-3"><i class="fa-solid fa-circle-check text-green me-2"></i> Strong network from block to farmer with practical field assistance</li>
            </ul>
            <a href="{{ route('about.index') }}" class="btn btn-primary-custom">Know More About BhuSanchar</a>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-soft">
      <div class="container-wide">
        <div class="row align-items-center g-5">
          <div class="col-lg-7">
            <div class="badge-level mb-3">Farmer Help Card</div>
            <h2 class="section-title">Farm More. Save More. Grow More.</h2>
            <div class="discount-box mb-4">
              <p class="mb-2 fw-semibold text-uppercase text-muted">Eligible farmers can receive</p>
              <h3>Up to 25%–50% OFF*</h3>
              <p class="mb-0 text-muted">on selected eligible BhuSanchar products.</p>
            </div>
            <div class="row g-3 mb-4">
              <div class="col-md-6"><i class="fa-solid fa-tags text-green me-2"></i> Product discounts</div>
              <div class="col-md-6"><i class="fa-solid fa-id-card text-green me-2"></i> Digital Farmer ID</div>
              <div class="col-md-6"><i class="fa-solid fa-qrcode text-green me-2"></i> QR-based verification</div>
              <div class="col-md-6"><i class="fa-solid fa-flask text-green me-2"></i> Soil-testing support</div>
              <div class="col-md-6"><i class="fa-solid fa-headset text-green me-2"></i> Farmer support</div>
              <div class="col-md-6"><i class="fa-solid fa-location-dot text-green me-2"></i> Local stock-point access</div>
            </div>
            <a href="{{ route('services.farmer-help-card') }}" class="btn btn-primary-custom">Apply for Farmer Help Card</a>
            <p class="mt-4 text-muted small">*Discounts are applicable only to eligible products and offers and may vary according to product category, campaign, location, stock availability and applicable terms and conditions.</p>
          </div>
          <div class="col-lg-5">
            <img src="https://images.unsplash.com/photo-1464226184884-fa52ac9fcf6b?auto=format&fit=crop&w=900&q=80" alt="Farmer card" class="img-fluid rounded-4 shadow-lg" />
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container-wide">
        <div class="d-flex justify-content-between align-items-end flex-wrap mb-5">
          <div>
            <div class="badge-level mb-3">Our Services</div>
            <h2 class="section-title mb-0">Modern agricultural support for every stage of farming.</h2>
          </div>
          <a href="{{ route('services.index') }}" class="btn btn-outline-custom">Explore All Services</a>
        </div>
        <div class="row g-4">
          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="step">01. Agricultural Products</div>
              <i class="fa-solid fa-tractor"></i>
              <h4>Quality fertilizers and agricultural inputs.</h4>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="step">02. Free Soil Testing</div>
              <i class="fa-solid fa-flask-vial"></i>
              <h4>Soil-test support for eligible farmers and programs.</h4>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="step">03. Farmer Support</div>
              <i class="fa-solid fa-handshake-angle"></i>
              <h4>Agricultural product and service assistance.</h4>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="step">04. Government Schemes</div>
              <i class="fa-solid fa-landmark"></i>
              <h4>Information and assistance with applicable programs.</h4>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="step">05. Logistics</div>
              <i class="fa-solid fa-truck"></i>
              <h4>Source-to-block-to-farmer distribution support.</h4>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="step">06. Technology</div>
              <i class="fa-solid fa-mobile-screen-button"></i>
              <h4>Digital tools for farmers and stock points.</h4>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-soft">
      <div class="container-wide">
        <div class="text-center mb-5">
          <div class="badge-level mb-3">Direct Distribution</div>
          <h2 class="section-title">From Block to Farmer</h2>
        </div>
        <div class="map-flow">
          <div class="flow-node">Source / Manufacturer</div>
          <div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div>
          <div class="flow-node">Warehouse</div>
          <div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div>
          <div class="flow-node">BhuSanchar Block Stock Point</div>
          <div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div>
          <div class="flow-node">Farmer / Customer</div>
        </div>
        <p class="text-center mt-5 section-subtitle mx-auto">BhuSanchar is building a streamlined distribution model focused on direct Block-to-Farmer/Customer fulfillment, supported by panchayat-level field outreach and technology.</p>
      </div>
    </section>

    <section class="section">
      <div class="container-wide">
        <div class="d-flex justify-content-between align-items-end flex-wrap mb-5">
          <div>
            <div class="badge-level mb-3">Pan-India Network</div>
            <h2 class="section-title mb-0">From One Block to Every Corner of India</h2>
          </div>
          <a href="{{ route('services.network') }}" class="btn btn-primary-custom">Explore Our Network</a>
        </div>
        <div class="map-flow justify-content-center">
          <div class="flow-node">India</div>
          <div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div>
          <div class="flow-node">State / UT</div>
          <div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div>
          <div class="flow-node">District</div>
          <div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div>
          <div class="flow-node">Block</div>
          <div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div>
          <div class="flow-node">Panchayat</div>
          <div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div>
          <div class="flow-node">Village</div>
          <div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div>
          <div class="flow-node">BhuSanchar Point</div>
          <div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div>
          <div class="flow-node">Farmer</div>
        </div>
      </div>
    </section>

    <section class="section section-soft">
      <div class="container-wide">
        <div class="d-flex justify-content-between align-items-end flex-wrap mb-5">
          <div>
            <div class="badge-level mb-3">Products</div>
            <h2 class="section-title mb-0">Agricultural Products Built Around Farmer Needs</h2>
          </div>
          <a href="{{ route('products') }}" class="btn btn-outline-custom">View Products</a>
        </div>
        <div class="row g-4" id="featuredProducts"></div>
      </div>
    </section>

    <section class="section">
      <div class="container-wide">
        <div class="text-center mb-5">
          <div class="badge-level mb-3">Farmer Journey</div>
          <h2 class="section-title">Simple steps to grow smarter.</h2>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-2-4">
            <div class="journey-step">
              <div class="num">01</div>
              <h5>Register</h5>
            </div>
          </div>
          <div class="col-md-6 col-lg-2-4">
            <div class="journey-step">
              <div class="num">02</div>
              <h5>Get Farmer Help Card</h5>
            </div>
          </div>
          <div class="col-md-6 col-lg-2-4">
            <div class="journey-step">
              <div class="num">03</div>
              <h5>Find Local BhuSanchar Point</h5>
            </div>
          </div>
          <div class="col-md-6 col-lg-2-4">
            <div class="journey-step">
              <div class="num">04</div>
              <h5>Access Products & Services</h5>
            </div>
          </div>
          <div class="col-md-6 col-lg-2-4">
            <div class="journey-step">
              <div class="num">05</div>
              <h5>Get Support & Benefits</h5>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="partner-banner">
      <div class="container-wide text-center">
        <div class="badge-level bg-white/10 text-white mb-3">Stock Point Partner</div>
        <h2 class="section-title text-white mb-4">Become a BhuSanchar Stock Point Partner</h2>
        <p class="text-white/80 mb-5 mx-auto" style="max-width: 800px;">Targeting fertilizer dealers, agricultural retailers, rural entrepreneurs, warehouse owners, distributors and eligible local businesses to expand trustworthy access to farm inputs.</p>
        <a href="{{ route('partner.index') }}" class="btn btn-primary-custom">Become a Partner</a>
      </div>
    </section>

    <section class="section section-soft">
      <div class="container-wide">
        <div class="d-flex justify-content-between align-items-end flex-wrap mb-5">
          <div>
            <div class="badge-level mb-3">Technology</div>
            <h2 class="section-title mb-0">Smart Agriculture Needs Smart Technology</h2>
          </div>
          <a href="{{ route('services.index') }}" class="btn btn-outline-custom">Explore Our Technology</a>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-4">
            <div class="tech-card bg-bhuGreen">
              <i class="fa-solid fa-mobile-screen-button fs-3 mb-3"></i>
              <h4>Farmer App</h4>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="tech-card bg-bhuFresh">
              <i class="fa-solid fa-store fs-3 mb-3"></i>
              <h4>Stock Point App</h4>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="tech-card bg-bhuNavy">
              <i class="fa-solid fa-user-tie fs-3 mb-3"></i>
              <h4>Officer App</h4>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="tech-card bg-bhuNavy">
              <i class="fa-solid fa-chart-line fs-3 mb-3"></i>
              <h4>ERP</h4>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="tech-card bg-bhuGreen">
              <i class="fa-solid fa-truck-fast fs-3 mb-3"></i>
              <h4>Logistics Platform</h4>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="tech-card bg-bhuFresh">
              <i class="fa-solid fa-chart-pie fs-3 mb-3"></i>
              <h4>Analytics</h4>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container-wide">
        <div class="d-flex justify-content-between align-items-end flex-wrap mb-5">
          <div>
            <div class="badge-level mb-3">Knowledge Center</div>
            <h2 class="section-title mb-0">BhuSanchar Krishi Gyan Kendra</h2>
          </div>
          <a href="{{ route('services.knowledge') }}" class="btn btn-outline-custom">Read Agriculture Knowledge</a>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="article-card">
              <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=900&q=80" alt="Fertilizer knowledge" />
              <div class="article-content">
                <div class="badge-level mb-2">Fertilizer</div>
                <h5>Choosing the right fertilizers for soil health.</h5>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="article-card">
              <img src="https://images.unsplash.com/photo-1471193945509-9ad0617afabf?auto=format&fit=crop&w=900&q=80" alt="Soil health" />
              <div class="article-content">
                <div class="badge-level mb-2">Soil Health</div>
                <h5>How soil testing improves crop productivity.</h5>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="article-card">
              <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=900&q=80" alt="Crop management" />
              <div class="article-content">
                <div class="badge-level mb-2">Crop Management</div>
                <h5>Seasonal crop practices for better yields.</h5>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="article-card">
              <img src="https://images.unsplash.com/photo-1523741543316-beb7fc7023d8?auto=format&fit=crop&w=900&q=80" alt="Government schemes" />
              <div class="article-content">
                <div class="badge-level mb-2">Government Schemes</div>
                <h5>Understanding support available to Indian farmers.</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-soft">
      <div class="container-wide">
        <div class="d-flex justify-content-between align-items-end flex-wrap mb-5">
          <div>
            <div class="badge-level mb-3">Careers</div>
            <h2 class="section-title mb-0">Build Your Career. Build Rural India.</h2>
          </div>
          <a href="{{ route('careers') }}" class="btn btn-outline-custom">Explore Careers</a>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-4">
            <div class="careers-card">
              <h4>District Officer</h4>
              <p class="text-muted mb-0">Leadership and network management.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="careers-card">
              <h4>Block Officer</h4>
              <p class="text-muted mb-0">Support operations at block level.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="careers-card">
              <h4>Panchayat Officer</h4>
              <p class="text-muted mb-0">Field outreach and local farmer support.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="careers-card">
              <h4>Agriculture Officer</h4>
              <p class="text-muted mb-0">Agronomy, guidance and field service.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="careers-card">
              <h4>Sales Officer</h4>
              <p class="text-muted mb-0">Market growth and field sales management.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="careers-card">
              <h4>Technology Team</h4>
              <p class="text-muted mb-0">Digital products, apps and analytics.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container-wide">
        <div class="text-center">
          <div class="badge-level mb-3">Together We Grow</div>
          <h2 class="section-title">Let's Build the Future of Agriculture Together.</h2>
          <p class="mx-auto section-subtitle mb-5" style="max-width: 800px;">From quality agricultural products to technology, from soil testing to farmer support, BhuSanchar is working to create a more connected agricultural ecosystem.</p>
          <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="{{ route('contact') }}" class="btn btn-primary-custom">Register as Farmer</a>
            <a href="{{ route('services.farmer-help-card') }}" class="btn btn-primary-custom">Get Farmer Help Card</a>
            <a href="{{ route('partner.index') }}" class="btn btn-outline-custom">Become a Partner</a>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
