const fs = require('fs');
const path = require('path');

const dir = 'd:/New folder';
const files = fs.readdirSync(dir).filter(f => f.endsWith('.html') && f !== 'admin.html');

const template = `          <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
            <li class="nav-item"><a class="nav-link" href="products.html">Products</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Services
              </a>
              <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                <li><a class="dropdown-item" href="services.html">All Services</a></li>
                <li><a class="dropdown-item" href="farmer-help-card.html">Farmer Help Card</a></li>
                <li><a class="dropdown-item" href="find-stock-point.html">Find Stock Point</a></li>
                <li><a class="dropdown-item" href="network.html">Our Network</a></li>
                <li><a class="dropdown-item" href="knowledge.html">Knowledge Center</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="resource.html">Resource</a></li>
            <li class="nav-item"><a class="nav-link" href="careers.html">Careers</a></li>
            <li class="nav-item"><a class="nav-link" href="partner.html">Partner With Us</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
          </ul>`;

files.forEach(file => {
    const filePath = path.join(dir, file);
    let content = fs.readFileSync(filePath, 'utf8');
    
    // Replace the existing ul
    content = content.replace(/<ul class="navbar-nav mx-auto">[\s\S]*?<\/ul>/, template);
    
    // Set active class for the current file
    // For nav-link
    const navLinkRegex = new RegExp(`class="nav-link" href="${file}"`);
    if (navLinkRegex.test(content)) {
        content = content.replace(navLinkRegex, `class="nav-link active" href="${file}"`);
    }
    
    // For dropdown-item
    const dropdownItemRegex = new RegExp(`class="dropdown-item" href="${file}"`);
    if (dropdownItemRegex.test(content)) {
        content = content.replace(dropdownItemRegex, `class="dropdown-item active" href="${file}"`);
        // Also highlight the parent Services dropdown
        content = content.replace(
            /class="nav-link dropdown-toggle"/, 
            'class="nav-link dropdown-toggle active"'
        );
    }
    
    fs.writeFileSync(filePath, content, 'utf8');
});

console.log('Dropdown updated for all pages.');
