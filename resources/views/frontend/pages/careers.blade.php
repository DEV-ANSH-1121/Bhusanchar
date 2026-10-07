@extends('frontend.layout.main')

@section('content')
    <section class="page-hero"><div class="container-wide"><div class="badge-level bg-white/10 text-white mb-3">Careers</div><h1>Build Your Career. Build Rural India.</h1></div></section>
    <main>
      <section class="section">
        <div class="container-wide">
          @if (session('status') === 'career-application-submitted')
            <div class="alert alert-success">Your application has been submitted. Our team will review your resume.</div>
          @endif

          @if ($careers->isEmpty())
            <div class="careers-card"><h4>No openings right now</h4><p class="text-muted mb-0">Check back soon for new roles across the BhuSanchar network.</p></div>
          @else
            <div class="row g-4">
              @foreach ($careers as $career)
                <div class="col-md-6 col-lg-4">
                  <div class="careers-card">
                    <h4>{{ $career->job_title }}</h4>
                    <p class="text-muted">{{ $career->job_description }}</p>
                    <p class="mb-1"><strong>Location:</strong> {{ $career->location }}</p>
                    <p class="mb-1"><strong>Salary:</strong> {{ $career->salary }}</p>
                    <p class="mb-3"><strong>Last date:</strong> {{ $career->last_application_date->format('d M Y') }}</p>
                    <h5 class="h6">Eligible criteria</h5>
                    <ul>
                      @foreach ($career->eligible_criteria as $point)
                        <li>{{ $point }}</li>
                      @endforeach
                    </ul>
                    <h5 class="h6">Key responsibilities</h5>
                    <ul class="mb-0">
                      @foreach ($career->key_responsibilities as $point)
                        <li>{{ $point }}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              @endforeach
            </div>

            <div class="form-box mt-5">
              <h3 class="mb-4">Apply for a role</h3>
              <form method="POST" action="{{ route('careers.apply') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label" for="career_id">Job opening</label>
                    <select class="form-select" id="career_id" name="career_id" required>
                      <option value="">Select a role</option>
                      @foreach ($careers as $career)
                        <option value="{{ $career->id }}" @selected((string) old('career_id') === (string) $career->id)>{{ $career->job_title }}</option>
                      @endforeach
                    </select>
                    @error('career_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-md-4"><label class="form-label" for="applicant_name">Name</label><input class="form-control" id="applicant_name" type="text" name="name" value="{{ old('name') }}" required />@error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                  <div class="col-md-4"><label class="form-label" for="applicant_email">Email</label><input class="form-control" id="applicant_email" type="email" name="email" value="{{ old('email') }}" required />@error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                  <div class="col-md-4"><label class="form-label" for="applicant_mobile">Mobile</label><input class="form-control" id="applicant_mobile" type="tel" name="mobile" value="{{ old('mobile') }}" required />@error('mobile')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                  <div class="col-12"><label class="form-label" for="resume">Resume (PDF, DOC, or DOCX, up to 5 MB)</label><input class="form-control" id="resume" type="file" name="resume" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required />@error('resume')<div class="text-danger small mt-1">{{ $message }}</div>@enderror</div>
                  <div class="col-12"><button class="btn btn-primary-custom" type="submit">Submit application</button></div>
                </div>
              </form>
            </div>
          @endif
        </div>
      </section>
    </main>
@endsection
