@extends('frontend.layout.main')

@section('content')
    <section class="page-hero">
      <div class="container-wide"><div class="badge-level bg-white/10 text-white mb-3">Farmer Help Card</div><h1>Your Farmer Card. Your Benefits. Your Savings.</h1></div>
    </section>
    <main>
      <section class="section">
        <div class="container-wide">
          <div class="row align-items-center g-5">
            <div class="col-lg-7">
              <div class="discount-box">
                <p class="mb-2 fw-semibold text-uppercase text-muted">Eligible farmers can receive</p>
                <h3>Up to 25%–50% OFF*</h3>
                <p class="mb-0 text-muted">Discounts on selected eligible BhuSanchar products.</p>
              </div>
              <div class="row g-3 mt-4">
                <div class="col-md-6"><i class="fa-solid fa-tags text-green me-2"></i>Discount on eligible products</div>
                <div class="col-md-6"><i class="fa-solid fa-id-card text-green me-2"></i>Farmer ID</div>
                <div class="col-md-6"><i class="fa-solid fa-qrcode text-green me-2"></i>QR verification</div>
                <div class="col-md-6"><i class="fa-solid fa-flask text-green me-2"></i>Soil testing access</div>
                <div class="col-md-6"><i class="fa-solid fa-headset text-green me-2"></i>Support services</div>
                <div class="col-md-6"><i class="fa-solid fa-store text-green me-2"></i>Nearby stock points</div>
              </div>
              <p class="mt-4 text-muted small">*Discounts are applicable only to eligible products and offers and may vary according to product category, campaign, location, stock availability and applicable terms and conditions.</p>
            </div>
            <div class="col-lg-5">
              <div class="form-box">
                <h3 class="mb-4">Apply Now</h3>
                <form method="POST" action="{{ route('services.farmer-help-card.store') }}" data-form-type="farmer-card" data-server-form>
                  @csrf
                  @if (session('status') === 'farmer-help-card-submitted')
                    <div class="alert alert-success">Your farmer help card application has been submitted.</div>
                  @endif
                  <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Full Name</label><input class="form-control" type="text" name="name" value="{{ old('name') }}" required />@error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email') }}" required />@error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">Mobile</label><input class="form-control" type="tel" name="mobile" value="{{ old('mobile') }}" required />@error('mobile')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">State</label><input class="form-control" type="text" name="state" value="{{ old('state') }}" required />@error('state')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">District</label><input class="form-control" type="text" name="district" value="{{ old('district') }}" required />@error('district')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">Block</label><input class="form-control" type="text" name="block" value="{{ old('block') }}" /></div>
                    <div class="col-md-6"><label class="form-label">Village</label><input class="form-control" type="text" name="village" value="{{ old('village') }}" /></div>
                    <div class="col-12"><label class="form-label">Preferred BhuSanchar Point</label><input class="form-control" type="text" name="preferred_bhusanchar_point" value="{{ old('preferred_bhusanchar_point') }}" /></div>
                    <div class="col-12"><div class="form-check"><input class="form-check-input" type="checkbox" id="consent" name="consent" value="1" @checked(old('consent')) required /><label class="form-check-label" for="consent">I agree to the terms and consent to necessary verification.</label></div>@error('consent')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-12"><button type="submit" class="btn btn-primary-custom w-100">Apply Now</button></div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection
