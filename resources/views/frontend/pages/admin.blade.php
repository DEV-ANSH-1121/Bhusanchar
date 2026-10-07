@extends('frontend.layout.main')

@section('content')
    <section class="page-hero">
      <div class="container-wide">
        <div class="badge-level bg-white/10 text-white mb-3">Admin</div>
        <h1>Operations Dashboard</h1>
      </div>
    </section>

    <main class="section">
      <div class="container-wide">
        <div id="adminDashboard"></div>
        <div class="mt-5 form-box">
          <h3 class="mb-4">Add a Product</h3>
          <form id="productForm">
            <div class="row g-3">
              <div class="col-md-6"><label class="form-label">Product Name</label><input type="text" id="productName" class="form-control" required /></div>
              <div class="col-md-6"><label class="form-label">Category</label><input type="text" id="productCategory" class="form-control" required /></div>
              <div class="col-md-6"><label class="form-label">Price (₹)</label><input type="number" id="productPrice" class="form-control" required /></div>
              <div class="col-md-6"><label class="form-label">Packaging</label><input type="text" id="productPackaging" class="form-control" required /></div>
              <div class="col-12"><label class="form-label">Description</label><textarea id="productDescription" class="form-control" rows="3" required></textarea></div>
              <div class="col-12"><button type="submit" class="btn btn-primary-custom">Save Product</button></div>
            </div>
          </form>
        </div>
      </div>
    </main>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const productForm = document.getElementById('productForm');
    if (productForm) {
      productForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const products = JSON.parse(localStorage.getItem('bhuSancharProducts') || '[]');
        const newProduct = {
          id: `admin-${Date.now()}`,
          name: document.getElementById('productName').value,
          category: document.getElementById('productCategory').value,
          description: document.getElementById('productDescription').value,
          suitableCrops: 'Custom catalog entry',
          packaging: document.getElementById('productPackaging').value,
          price: Number(document.getElementById('productPrice').value),
          image: 'https://images.unsplash.com/photo-1464226184884-fa52ac9fcf6b?auto=format&fit=crop&w=900&q=80'
        };
        products.unshift(newProduct);
        localStorage.setItem('bhuSancharProducts', JSON.stringify(products));
        productForm.reset();
        renderAdminDashboard();
        renderProductsGrid();
        renderHomeProducts();
        alert('Product added to catalog.');
      });
    }
  });
</script>
@endpush
