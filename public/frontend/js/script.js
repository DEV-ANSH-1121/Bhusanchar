const STORAGE_KEYS = {
  products: 'bhuSancharProducts',
  contactForms: 'bhuSancharContactForms',
  partnerApplications: 'bhuSancharPartnerApplications',
  farmerCards: 'bhuSancharFarmerCards',
  adminNotes: 'bhuSancharAdminNotes'
};

const currencyFormatter = new Intl.NumberFormat('en-IN', {
  style: 'currency',
  currency: 'INR',
  maximumFractionDigits: 0
});

const productApiUrl = route('api.products.index');

let defaultProducts = [];

async function getStoredProducts() {
    try {
        const response = await fetch(productApiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                search: '',
                category: ''
            })
        });

        if (!response.ok) {
            throw new Error('Failed to fetch products.');
        }

        const data = await response.json();

        defaultProducts = Array.isArray(data.data) ? data.data : [];

        return defaultProducts;
    } catch (error) {
        console.error('Products API error:', error);

        defaultProducts = [];

        return defaultProducts;
    }
}

async function renderProductsGrid() {
    const grid = document.getElementById('productGrid');

    if (!grid) return;

    const products = await getStoredProducts();

    const search = document.getElementById('productSearch');
    const filter = document.getElementById('categoryFilter');

    const query = (search?.value || '').toLowerCase().trim();
    const selectedCategory = filter?.value || 'All';

    const filtered = products.filter(function (product) {
        const searchableText = [
            product.name,
            product.category,
            product.description,
            product.suitableCrops
        ]
            .filter(Boolean)
            .join(' ')
            .toLowerCase();

        const matchesSearch =
            !query || searchableText.includes(query);

        const matchesCategory =
            selectedCategory === 'All' ||
            !selectedCategory ||
            product.category === selectedCategory;

        return matchesSearch && matchesCategory;
    });

    const categories = [
        'All',
        ...new Set(
            products
                .map(function (product) {
                    return product.category;
                })
                .filter(Boolean)
        )
    ];

    if (filter && filter.options.length === 1) {
        categories.forEach(function (category) {
            const option = document.createElement('option');

            option.value = category;
            option.textContent = category;

            filter.appendChild(option);
        });
    }

    grid.replaceChildren();

    if (!filtered.length) {
        const wrapper = document.createElement('div');
        wrapper.className = 'col-12';

        const alert = document.createElement('div');
        alert.className = 'alert alert-light border';
        alert.textContent = 'No products match your search.';

        wrapper.appendChild(alert);
        grid.appendChild(wrapper);

        return;
    }

    filtered.forEach(function (product) {
        const column = document.createElement('div');
        column.className = 'col-md-6 col-lg-4';

        const card = document.createElement('div');
        card.className = 'card-modern';

        const image = document.createElement('img');

        if (product.image_url) {
            image.src = product.image_url;
        }

        image.className = 'img-fluid rounded-3 mb-3';
        image.alt = String(product.name || '');
        image.style.height = '220px';
        image.style.objectFit = 'cover';
        image.style.width = '100%';

        image.onerror = function () {
            console.error('Failed to load product image:', product.image_url);
        };

        card.appendChild(image);

        if (product.category) {
            const badge = document.createElement('span');
            badge.className = 'badge-level';
            badge.textContent = String(product.category);

            card.appendChild(badge);
        }

        const title = document.createElement('h4');
        title.className = 'mt-3';
        title.textContent = String(product.name || '');

        card.appendChild(title);

        const description = document.createElement('p');
        description.className = 'text-muted';
        description.textContent = String(product.description || '');

        card.appendChild(description);

        const details = document.createElement('ul');
        details.className = 'list-unstyled small text-muted';

        if (product.suitableCrops) {
            const item = document.createElement('li');

            const label = document.createElement('strong');
            label.textContent = 'Suitable crops: ';

            item.appendChild(label);
            item.appendChild(
                document.createTextNode(String(product.suitableCrops))
            );

            details.appendChild(item);
        }

        if (product.packaging) {
            const item = document.createElement('li');

            const label = document.createElement('strong');
            label.textContent = 'Packaging: ';

            item.appendChild(label);
            item.appendChild(
                document.createTextNode(String(product.packaging))
            );

            details.appendChild(item);
        }

        if (
            product.price !== null &&
            product.price !== undefined &&
            product.price !== ''
        ) {
            const item = document.createElement('li');

            const label = document.createElement('strong');
            label.textContent = 'Price: ';

            item.appendChild(label);

            const price = Number(product.price);

            item.appendChild(
                document.createTextNode(
                    Number.isFinite(price)
                        ? currencyFormatter.format(price)
                        : String(product.price)
                )
            );

            details.appendChild(item);
        }

        card.appendChild(details);

        const actions = document.createElement('div');
        actions.className = 'd-flex gap-2 mt-3';

        const enquireButton = document.createElement('button');
        enquireButton.type = 'button';
        enquireButton.className = 'btn btn-primary-custom btn-sm';
        enquireButton.textContent = 'Enquire';
        enquireButton.dataset.product = String(product.name || '');

        const findNearbyLink = document.createElement('a');
        findNearbyLink.className = 'btn btn-outline-custom btn-sm';
        findNearbyLink.textContent = 'Find Nearby';

        const contactUrl = new URL('/contact', window.location.origin);

        if (product.name) {
            contactUrl.searchParams.set('product', String(product.name));
        }

        findNearbyLink.href = contactUrl.toString();

        actions.appendChild(enquireButton);
        actions.appendChild(findNearbyLink);

        card.appendChild(actions);
        column.appendChild(card);
        grid.appendChild(column);
    });

    grid.querySelectorAll('[data-product]').forEach(function (button) {
        button.addEventListener('click', function () {
            const productName = button.dataset.product || '';

            const form = document.querySelector(
                'form[data-form-type="contact"]'
            );

            if (form) {
                const productField = form.querySelector(
                    'input[name="product_interested"], input[name="productName"]'
                );

                if (productField) {
                    productField.value = productName;
                }
            }

            const contactUrl = new URL(
                '/contact',
                window.location.origin
            );

            if (productName) {
                contactUrl.searchParams.set('product', productName);
            }

            window.location.href = contactUrl.toString();
        });
    });
}

function seedStorage() {
  Object.entries(STORAGE_KEYS).forEach(([key, storageKey]) => {
    if (storageKey === STORAGE_KEYS.products && !localStorage.getItem(storageKey)) {
      localStorage.setItem(storageKey, JSON.stringify(defaultProducts));
    }

    if (storageKey !== STORAGE_KEYS.products && !localStorage.getItem(storageKey)) {
      localStorage.setItem(storageKey, JSON.stringify([]));
    }
  });
}

function showToast(message, type = 'success') {
  let toast = document.getElementById('toastBox');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'toastBox';
    toast.style.position = 'fixed';
    toast.style.bottom = '24px';
    toast.style.right = '24px';
    toast.style.zIndex = '9999';
    toast.style.minWidth = '240px';
    document.body.appendChild(toast);
  }

  const alertBox = document.createElement('div');
  alertBox.className = `alert ${type === 'success' ? 'alert-success' : 'alert-danger'} mb-2`;
  alertBox.innerHTML = `<strong>${type === 'success' ? 'Success' : 'Notice'}:</strong> ${message}`;
  toast.appendChild(alertBox);

  setTimeout(() => {
    alertBox.remove();
  }, 2800);
}

function setYear() {
  const yearNodes = document.querySelectorAll('#year');
  yearNodes.forEach((node) => {
    node.textContent = new Date().getFullYear();
  });
}

function bindNavigationState() {
  const currentPage = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-link').forEach((link) => {
    const target = link.getAttribute('href');
    if (target === currentPage) {
      link.classList.add('active');
    }
  });
}

function renderHomeProducts() {
  const container = document.getElementById('featuredProducts');
  if (!container) return;

  const products = getStoredProducts().slice(0, 4);
  container.innerHTML = products.map((product) => `
    <div class="col-md-6 col-lg-3">
      <div class="card-modern h-100">
        <img src="${product.image}" alt="${product.name}" class="img-fluid rounded-3 mb-3" style="height: 180px; object-fit: cover; width: 100%;" />
        <span class="badge-level">${product.category}</span>
        <h5 class="mt-3">${product.name}</h5>
        <p class="text-muted small mb-0">${currencyFormatter.format(product.price)}</p>
      </div>
    </div>
  `).join('');
}

function attachFormHandlers() {
  document.querySelectorAll('form[data-form-type]').forEach((form) => {
    if (form.hasAttribute('data-server-form')) {
      return;
    }

    form.addEventListener('submit', (event) => {
      event.preventDefault();
      const type = form.getAttribute('data-form-type');
      const formData = new FormData(form);
      const payload = Object.fromEntries(formData.entries());
      payload.id = `${type}-${Date.now()}`;
      payload.createdAt = new Date().toISOString();
      payload.status = 'new';

      const storageKey = {
        contact: STORAGE_KEYS.contactForms,
        partner: STORAGE_KEYS.partnerApplications,
        'farmer-card': STORAGE_KEYS.farmerCards
      }[type];

      if (!storageKey) return;

      const existing = JSON.parse(localStorage.getItem(storageKey) || '[]');
      existing.unshift(payload);
      localStorage.setItem(storageKey, JSON.stringify(existing));
      form.reset();
      showToast(`${type === 'contact' ? 'Contact message' : type === 'partner' ? 'Partner application' : 'Farmer Help Card request'} submitted successfully.`);

      if (window.location.pathname.endsWith('admin.html')) {
        renderAdminDashboard();
      }
    });
  });
}

function renderAdminDashboard() {
  const adminRoot = document.getElementById('adminDashboard');
  if (!adminRoot) return;

  const contactForms = JSON.parse(localStorage.getItem(STORAGE_KEYS.contactForms) || '[]');
  const partnerApplications = JSON.parse(localStorage.getItem(STORAGE_KEYS.partnerApplications) || '[]');
  const farmerCards = JSON.parse(localStorage.getItem(STORAGE_KEYS.farmerCards) || '[]');
  const products = getStoredProducts();

  const total = contactForms.length + partnerApplications.length + farmerCards.length;
  adminRoot.innerHTML = `
    <div class="row g-4">
      <div class="col-md-3"><div class="metric-box"><span class="metric">${products.length}</span><p class="mb-0">Products</p></div></div>
      <div class="col-md-3"><div class="metric-box"><span class="metric">${contactForms.length}</span><p class="mb-0">Contacts</p></div></div>
      <div class="col-md-3"><div class="metric-box"><span class="metric">${partnerApplications.length}</span><p class="mb-0">Partners</p></div></div>
      <div class="col-md-3"><div class="metric-box"><span class="metric">${farmerCards.length}</span><p class="mb-0">Farmer cards</p></div></div>
    </div>
    <div class="mt-5">
      <h4 class="mb-3">Recent submissions</h4>
      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead>
            <tr>
              <th>Type</th>
              <th>Submitted By</th>
              <th>Primary Detail</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            ${[
              ...contactForms.map((entry) => ({
                type: 'Contact',
                person: entry.name || 'Unnamed',
                detail: entry.inquiryType || entry.email || 'General enquiry',
                status: entry.status || 'new'
              })),
              ...partnerApplications.map((entry) => ({
                type: 'Partner',
                person: entry.applicantName || entry.businessName || 'Unnamed',
                detail: entry.businessName || entry.email || 'Partner request',
                status: entry.status || 'new'
              })),
              ...farmerCards.map((entry) => ({
                type: 'Farmer Card',
                person: entry.fullName || 'Unnamed',
                detail: entry.mobile || entry.state || 'No mobile available',
                status: entry.status || 'new'
              }))
            ].slice(0, 8).map((row) => `
              <tr>
                <td>${row.type}</td>
                <td>${row.person}</td>
                <td>${row.detail}</td>
                <td><span class="badge-level">${row.status}</span></td>
              </tr>
            `).join('') || '<tr><td colspan="4">No submissions yet.</td></tr>'}
          </tbody>
        </table>
      </div>
    </div>
  `;
}

function initializeProductSearch() {
  const searchInput = document.getElementById('productSearch');
  const filterSelect = document.getElementById('categoryFilter');
  if (searchInput) searchInput.addEventListener('input', renderProductsGrid);
  if (filterSelect) filterSelect.addEventListener('change', renderProductsGrid);
}

function initializeContactPrefill() {
  const params = new URLSearchParams(window.location.search);
  const productName = params.get('product');
  if (!productName) return;

  const productField = document.querySelector('input[name="product_interested"], input[name="productName"]');
  if (productField) productField.value = productName;
}

document.addEventListener('DOMContentLoaded', function () {
  seedStorage();
  setYear();
  bindNavigationState();
  renderHomeProducts();
  renderProductsGrid();
  initializeProductSearch();
  initializeContactPrefill();
  attachFormHandlers();
  renderAdminDashboard();
});
