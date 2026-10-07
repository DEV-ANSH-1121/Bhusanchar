const fs = require('fs');
const path = require('path');

const dir = 'd:/New folder';
const files = fs.readdirSync(dir).filter(f => f.endsWith('.html') && f !== 'admin.html');

const template = `          <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                About
              </a>
              <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                <li><a class="dropdown-item" href="about.html">About Bhusanchar</a></li>
                <li><a class="dropdown-item" href="#">Mission and Vision</a></li>
                <li><a class="dropdown-item" href="#">Our Team</a></li>
                <li><a class="dropdown-item" href="#">Investor</a></li>
              </ul>
            </li>
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
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="resourceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Resource
              </a>
              <ul class="dropdown-menu" aria-labelledby="resourceDropdown">
                <li><a class="dropdown-item" href="#">Life at Bhusanchar</a></li>
                <li><a class="dropdown-item" href="#">Blog</a></li>
                <li><a class="dropdown-item" href="resource.html">Gallery</a></li>
                <li><a class="dropdown-item" href="#">Press</a></li>
                <li><a class="dropdown-item" href="#">Krishi Gyan</a></li>
              </ul>
            </li>
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
    const regex = /<ul class="navbar-nav mx-auto">[\s\S]*?<\/ul>\s*(?=<a href="farmer-help-card\.html" class="btn btn-primary-custom">)/;
    
    content = content.replace(regex, template + '\n          ');
    
    // Set active class for the current file
    
    const navLinkRegex = new RegExp(`class="nav-link" href="${file}"`);
    if (navLinkRegex.test(content)) {
        content = content.replace(navLinkRegex, `class="nav-link active" href="${file}"`);
    }
    
    const dropdownItemRegex = new RegExp(`class="dropdown-item" href="${file}"`);
    if (dropdownItemRegex.test(content)) {
        content = content.replace(dropdownItemRegex, `class="dropdown-item active" href="${file}"`);
        
        const servicesPages = ['services.html', 'farmer-help-card.html', 'find-stock-point.html', 'network.html', 'knowledge.html'];
        const partnerPages = ['partner.html'];
        const aboutPages = ['about.html'];
        const resourcePages = ['resource.html'];
        
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
        } else if (aboutPages.includes(file)) {
            content = content.replace(
                /<a class="nav-link dropdown-toggle" href="#" id="aboutDropdown"/, 
                '<a class="nav-link dropdown-toggle active" href="#" id="aboutDropdown"'
            );
        } else if (resourcePages.includes(file)) {
            content = content.replace(
                /<a class="nav-link dropdown-toggle" href="#" id="resourceDropdown"/, 
                '<a class="nav-link dropdown-toggle active" href="#" id="resourceDropdown"'
            );
        }
    }
    
    fs.writeFileSync(filePath, content, 'utf8');
});

console.log('Resource dropdown fixed and updated for all pages.');
