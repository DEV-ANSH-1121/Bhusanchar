@extends('frontend.layout.main')

@section('content')
    <section class="page-hero"><div class="container-wide"><div class="badge-level bg-white/10 text-white mb-3">Resource</div><h1>Snapshots from the field and the network.</h1></div></section>
    <main>
      <section class="section">
        <div class="container-wide">
          <div class="mb-5">
            <span class="filter-chip">Farmers</span><span class="filter-chip">Soil Testing</span><span class="filter-chip">Products</span><span class="filter-chip">Stock Points</span><span class="filter-chip">Training</span><span class="filter-chip">Events</span><span class="filter-chip">Technology</span><span class="filter-chip">Team</span>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-3"><img class="img-fluid rounded-4 shadow-sm" src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=900&q=80" alt="Farmers" /></div>
            <div class="col-md-6 col-lg-3"><img class="img-fluid rounded-4 shadow-sm" src="https://images.unsplash.com/photo-1471193945509-9ad0617afabf?auto=format&fit=crop&w=900&q=80" alt="Soil testing" /></div>
            <div class="col-md-6 col-lg-3"><img class="img-fluid rounded-4 shadow-sm" src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=900&q=80" alt="Products" /></div>
            <div class="col-md-6 col-lg-3"><img class="img-fluid rounded-4 shadow-sm" src="https://images.unsplash.com/photo-1523741543316-beb7fc7023d8?auto=format&fit=crop&w=900&q=80" alt="Stock point" /></div>
            <div class="col-md-6 col-lg-3"><img class="img-fluid rounded-4 shadow-sm" src="https://images.unsplash.com/photo-1492496913980-501348b61469?auto=format&fit=crop&w=900&q=80" alt="Training" /></div>
            <div class="col-md-6 col-lg-3"><img class="img-fluid rounded-4 shadow-sm" src="https://images.unsplash.com/photo-1464226184884-fa52ac9fcf6b?auto=format&fit=crop&w=900&q=80" alt="Event" /></div>
            <div class="col-md-6 col-lg-3"><img class="img-fluid rounded-4 shadow-sm" src="https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=900&q=80" alt="Technology" /></div>
            <div class="col-md-6 col-lg-3"><img class="img-fluid rounded-4 shadow-sm" src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=900&q=80" alt="Team" /></div>
          </div>
        </div>
      </section>
    </main>
@endsection
