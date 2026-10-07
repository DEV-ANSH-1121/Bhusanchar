@extends('frontend.layout.main')

@section('content')
    <section class="page-hero">
      <div class="container-wide">
        <div class="badge-level bg-white/10 text-white mb-3">Products</div>
        <h1>Quality agricultural inputs for modern farmers.</h1>
      </div>
    </section>

    <main>
      <section class="section">
        <div class="container-wide">
          <div class="row mb-4 g-3 align-items-center">
            <div class="col-md-6">
              <input id="productSearch" type="text" class="form-control" placeholder="Search products, categories, crops..." />
            </div>
            <div class="col-md-3">
              <select id="categoryFilter" class="form-select">
                <option value="All">All categories</option>
              </select>
            </div>
            <div class="col-md-3 text-md-end">
              <a href="{{ route('contact') }}" class="btn btn-primary-custom">Request Product</a>
            </div>
          </div>
          <div class="row g-4" id="productGrid"></div>
        </div>
      </section>
    </main>
@endsection

@push('scripts')
    <script>
        fetch('{{ route('api.products.index') }}', {
            method: 'POST',
            body: JSON.stringify({
                search: '',
                category: '',
            }),
        }).then(response => response.json()).then(data => {
            console.log(data);
        }).catch(error => {
            console.log(error);
        });
    </script>
@endpush('scripts')
