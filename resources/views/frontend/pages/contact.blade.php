@extends('frontend.layout.main')

@section('content')
    <section class="page-hero"><div class="container-wide"><div class="badge-level bg-white/10 text-white mb-3">Contact Us</div><h1>We Are Here to Connect.</h1></div></section>
    <main>
      <section class="section">
        <div class="container-wide">
          <div class="row g-5">
            <div class="col-lg-5">
              <div class="card-modern">
                <h3 class="mb-3">Contact Information</h3>
                <p><strong>Founder:</strong> Vijay Kumar</p>
                <p><strong>Mobile:</strong> +91 9801892639</p>
                <p><strong>Email:</strong> cs.vijay29@gmail.com</p>
                <div class="mt-4">
                  <span class="filter-chip">Farmer Support</span>
                  <span class="filter-chip">Stock Point</span>
                  <span class="filter-chip">Partnership</span>
                  <span class="filter-chip">Career</span>
                  <span class="filter-chip">Product Enquiry</span>
                  <span class="filter-chip">Technology</span>
                  <span class="filter-chip">General Enquiry</span>
                </div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="form-box">
                <h3 class="mb-4">Send a Message</h3>
                <form method="POST" action="{{ route('contact.store') }}" data-form-type="contact" data-server-form>
                  @csrf
                  @if (session('status') === 'contact-submitted')
                    <div class="alert alert-success">Your message has been sent. Our team will contact you soon.</div>
                  @endif
                  <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Name</label><input class="form-control" type="text" name="name" value="{{ old('name') }}" required />@error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">Mobile</label><input class="form-control" type="tel" name="mobile" value="{{ old('mobile') }}" required />@error('mobile')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email') }}" required />@error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">Product Interested</label><input class="form-control" type="text" name="product_interested" value="{{ old('product_interested') }}" />@error('product_interested')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-md-6"><label class="form-label">State</label><input class="form-control" type="text" name="state" value="{{ old('state') }}" /></div>
                    <div class="col-md-6"><label class="form-label">District</label><input class="form-control" type="text" name="district" value="{{ old('district') }}" /></div>
                    <div class="col-md-6"><label class="form-label">Block</label><input class="form-control" type="text" name="block" value="{{ old('block') }}" /></div>
                    <div class="col-12"><label class="form-label">Inquiry Type</label><select class="form-select" name="inquiry_type" required>@foreach (\App\Enums\InquiryType::cases() as $inquiryType)<option value="{{ $inquiryType->value }}" @selected((string) old('inquiry_type', \App\Enums\InquiryType::FarmerSupport->value) === (string) $inquiryType->value)>{{ $inquiryType->label() }}</option>@endforeach</select>@error('inquiry_type')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-12"><label class="form-label">Message</label><textarea class="form-control" rows="5" name="message" required>{{ old('message') }}</textarea>@error('message')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                    <div class="col-12"><button class="btn btn-primary-custom w-100" type="submit">Send Message</button></div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection
