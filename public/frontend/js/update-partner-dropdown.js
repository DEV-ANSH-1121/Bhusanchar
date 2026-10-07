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
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="partnerDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Partner With Us
              </a>
              <ul class="dropdown-menu" aria-labelledby="partnerDropdown">
                <li><a class="dropdown-item" href="partner.html">Partner With Us</a></li>
                <li><a class="dropdown-item" href="#">Block Stock Point</a></li>
                <li><a class="dropdown-item" href="#">Panchayat Stock Point</a></li>
                <li><a class="dropdown-item" href="#">Last Mile Delivery</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
          </ul>`;

files.forEach(file => {
    const filePath = path.join(dir, file);
    let content = fs.readFileSync(filePath, 'utf8');
    
    // Replace the existing ul block completely, matching up to the button
    // This fixes the corrupted structure where we had extra </ul> and list items
    const regex = /<ul class="navbar-nav mx-auto">[\s\S]*?<\/ul>\s*(?=<a href="farmer-help-card\.html" class="btn btn-primary-custom">)/;
    
    content = content.replace(regex, template + '\n          ');
    
    // Set active class for the current file
    // First clear all existing active classes on nav-links and dropdown-items just in case?
    // Let's just do standard string replacements.
    
    const navLinkRegex = new RegExp(`class="nav-link" href="${file}"`);
    if (navLinkRegex.test(content)) {
        content = content.replace(navLinkRegex, `class="nav-link active" href="${file}"`);
    }
    
    const dropdownItemRegex = new RegExp(`class="dropdown-item" href="${file}"`);
    if (dropdownItemRegex.test(content)) {
        content = content.replace(dropdownItemRegex, `class="dropdown-item active" href="${file}"`);
        
        const servicesPages = ['services.html', 'farmer-help-card.html', 'find-stock-point.html', 'network.html', 'knowledge.html'];
        const partnerPages = ['partner.html'];
        
        if (servicesPages.includes(file)) {
            content = content.replace(
                /<a class="nav-link dropdown-toggle" href="#" id="servicesDropdown"/, 
                '<a class="nav-link dropdown-toggle active" href="#" id="servicesDropdown"'
            );
        } else if (partnerPages.includes(file)) {
            content = content.replace(
                /<a class="nav-link dropdown-toggle" href="#" id="partnerDropdown"/, 
                '<a class="nav-link dropdown-toggle active" href="#" id="partnerDropdown"'
            );
        }
    }
    
    fs.writeFileSync(filePath, content, 'utf8');
});

console.log('Partner dropdown fixed and updated for all pages.');
