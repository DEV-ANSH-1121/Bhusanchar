@extends('frontend.layout.main')

@section('content')
    <section class="page-hero"><div class="container-wide"><div class="badge-level bg-white/10 text-white mb-3">Find Stock Point</div><h1>Find Your Nearest BhuSanchar Point</h1></div></section>
    <main>
      <section class="section">
        <div class="container-wide">
          <div class="row g-4 align-items-start">
            <div class="col-lg-4">
              <div class="form-box">
                <h3 class="mb-4">Search by Location</h3>
                <div class="row g-3">
                  <div class="col-12"><label class="form-label">State</label><select class="form-select"><option>Bihar</option><option>Jharkhand</option><option>Odisha</option><option>West Bengal</option></select></div>
                  <div class="col-12"><label class="form-label">District</label><select class="form-select"><option>Patna</option><option>Gaya</option><option>Ranchi</option><option>Balasore</option></select></div>
                  <div class="col-12"><label class="form-label">Block</label><select class="form-select"><option>Patna Sadar</option><option>Danapur</option><option>Gaya Block</option></select></div>
                  <div class="col-12"><label class="form-label">Panchayat</label><select class="form-select"><option>Bhojpur</option><option>Hajipur</option><option>Kankarbagh</option></select></div>
                  <div class="col-12"><label class="form-label">Village</label><input class="form-control" type="text" placeholder="Village name" /></div>
                  <div class="col-12"><button class="btn btn-primary-custom w-100">Search Nearby Points</button></div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="stock-card">
                <div class="thumb"><i class="fa-solid fa-location-dot"></i></div>
                <div class="p-4">
                  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                    <h4 class="mb-0">BhuSanchar Patna Stock Point</h4>
                    <span class="badge-level">Verified Partner</span>
                  </div>
                  <p class="text-muted mb-3">Near Kankarbagh, Patna, Bihar</p>
                  <div class="row g-3 mb-3">
                    <div class="col-md-6"><strong>Phone:</strong> +91 9801892639</div>
                    <div class="col-md-6"><strong>Distance:</strong> 4.2 km</div>
                    <div class="col-md-6"><strong>Working Hours:</strong> 8:00 AM – 7:00 PM</div>
                    <div class="col-md-6"><strong>Products:</strong> Fertilizer, Soil Mix, Micronutrients</div>
                    <div class="col-md-6"><strong>Services:</strong> Soil testing, farmer support</div>
                    <div class="col-md-6"><strong>Delivery:</strong> Available</div>
                  </div>
                  <div class="d-flex gap-3 flex-wrap">
                    <a href="#" class="btn btn-primary-custom">Get Directions</a>
                    <a href="tel:+919801892639" class="btn btn-outline-custom">Call</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-custom">Request Product</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection
