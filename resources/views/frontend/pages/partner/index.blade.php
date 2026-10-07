@extends('frontend.layout.main')

@section('content')
    <section class="page-hero"><div class="container-wide"><div class="badge-level bg-white/10 text-white mb-3">Partner With Us</div><h1>Let's Build the Future of Agriculture Together.</h1></div></section>
    <main>
      <section class="section">
        <div class="container-wide">
          <div class="row g-5 align-items-start">
            <div class="col-lg-5">
              <div class="card-modern">
                <h3 class="mb-3">Who can apply?</h3>
                <ul class="list-unstyled">
                  <li class="mb-2"><i class="fa-solid fa-circle-check text-green me-2"></i>Agricultural retailers</li>
                  <li class="mb-2"><i class="fa-solid fa-circle-check text-green me-2"></i>Fertilizer dealers</li>
                  <li class="mb-2"><i class="fa-solid fa-circle-check text-green me-2"></i>Rural entrepreneurs</li>
                  <li class="mb-2"><i class="fa-solid fa-circle-check text-green me-2"></i>Distributors and warehouse owners</li>
                  <li class="mb-2"><i class="fa-solid fa-circle-check text-green me-2"></i>Local businesses in agriculture</li>
                </ul>
                <h4 class="mt-4">Partner benefits</h4>
                <ul class="list-unstyled">
                  <li class="mb-2"><i class="fa-solid fa-circle-check text-green me-2"></i>Product access</li>
                  <li class="mb-2"><i class="fa-solid fa-circle-check text-green me-2"></i>Technology platform</li>
                  <li class="mb-2"><i class="fa-solid fa-circle-check text-green me-2"></i>Inventory and ordering support</li>
                  <li class="mb-2"><i class="fa-solid fa-circle-check text-green me-2"></i>Logistics and training support</li>
                  <li class="mb-2"><i class="fa-solid fa-circle-check text-green me-2"></i>Farmer network and marketing support</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="form-box">
                <h3 class="mb-4">Submit Partner Application</h3>
                <form method="POST" action="{{ route('partner.store') }}" data-form-type="partner" data-server-form>
                  @csrf
                  @if (session('status') === 'stock-point-submitted')
                    <div class="alert alert-success">Your stock point application has been submitted.</div>
                  @endif
                  <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Applicant Name</label><input class="form-control" type="text" name="applicant_name" value="{{ old('applicant_name') }}" required />@error('applicant_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">Business Name</label><input class="form-control" type="text" name="business_name" value="{{ old('business_name') }}" required />@error('business_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">Mobile</label><input class="form-control" type="tel" name="mobile" value="{{ old('mobile') }}" required />@error('mobile')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email') }}" required />@error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">State</label><input class="form-control" type="text" name="state" value="{{ old('state') }}" /></div>
                    <div class="col-md-6"><label class="form-label">District</label><input class="form-control" type="text" name="district" value="{{ old('district') }}" /></div>
                    <div class="col-md-6"><label class="form-label">Block</label><input class="form-control" type="text" name="block" value="{{ old('block') }}" /></div>
                    <div class="col-md-6"><label class="form-label">Panchayat</label><input class="form-control" type="text" name="panchayat" value="{{ old('panchayat') }}" /></div>
                    <div class="col-12"><label class="form-label">Business Address</label><textarea class="form-control" rows="3" name="business_address">{{ old('business_address') }}</textarea></div>
                    <div class="col-12"><button class="btn btn-primary-custom w-100" type="submit">Submit Partner Application</button></div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection
