@extends('frontend.layout.main')

@section('content')
    <section class="page-hero"><div class="container-wide"><div class="badge-level bg-white/10 text-white mb-3">Our Network</div><h1>Pan-India BhuSanchar Network</h1></div></section>
    <main>
      <section class="section">
        <div class="container-wide">
          <div class="map-flow mb-5">
            <div class="flow-node">India</div><div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div><div class="flow-node">States / UTs</div><div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div><div class="flow-node">Districts</div><div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div><div class="flow-node">Blocks</div><div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div><div class="flow-node">Panchayats</div><div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div><div class="flow-node">Villages</div><div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div><div class="flow-node">Stock Points</div><div class="flow-arrow"><i class="fa-solid fa-arrow-down"></i></div><div class="flow-node">Farmers</div>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-4"><div class="metric-box"><span class="metric">18+</span><p class="mb-0">States covered</p></div></div>
            <div class="col-md-6 col-lg-4"><div class="metric-box"><span class="metric">500+</span><p class="mb-0">Stock points</p></div></div>
            <div class="col-md-6 col-lg-4"><div class="metric-box"><span class="metric">20k+</span><p class="mb-0">Registered farmers</p></div></div>
            <div class="col-md-6 col-lg-4"><div class="metric-box"><span class="metric">3k+</span><p class="mb-0">Soil tests</p></div></div>
            <div class="col-md-6 col-lg-4"><div class="metric-box"><span class="metric">10k+</span><p class="mb-0">Products distributed</p></div></div>
            <div class="col-md-6 col-lg-4"><div class="metric-box"><span class="metric">Live</span><p class="mb-0">Verified and growing network</p></div></div>
          </div>
        </div>
      </section>
    </main>
@endsection
