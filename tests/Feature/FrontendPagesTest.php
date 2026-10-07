<?php

test('frontend pages render their primary heading', function (string $uri, string $heading) {
    $this->get($uri)->assertSee($heading, false);
})->with([
    'home' => ['/', 'Empowering Farmers. Strengthening Agriculture. Connecting Rural India.'],
    'about' => ['/about', 'Agriculture Is Our Foundation. Farmers Are Our Priority.'],
    'mission' => ['/about/mission', 'Connecting Farmers with Opportunity, Support, and Growth.'],
    'team' => ['/about/team', 'People working closely with farmers and rural communities.'],
    'investor' => ['/about/investor', 'Building the Next Agricultural Network of India.'],
    'products' => ['/products', 'Quality agricultural inputs for modern farmers.'],
    'services' => ['/services', 'Agriculture, technology &amp; support — connected around the farmer.'],
    'farmer help card' => ['/services/farmer-help-card', 'Your Farmer Card. Your Benefits. Your Savings.'],
    'find stock point' => ['/services/find-stock-point', 'Find Your Nearest BhuSanchar Point'],
    'network' => ['/services/network', 'Pan-India BhuSanchar Network'],
    'knowledge' => ['/services/knowledge', 'BhuSanchar Krishi Gyan Kendra'],
    'gallery' => ['/resource/gallery', 'Snapshots from the field and the network.'],
    'partner' => ['/partner', 'Let\'s Build the Future of Agriculture Together.'],
    'contact' => ['/contact', 'We Are Here to Connect.'],
    'admin' => ['/admin', 'Operations Dashboard'],
]);

test('navigation uses named routes instead of html files', function () {
    $this->get('/')
        ->assertSee(route('about.index'), false)
        ->assertDontSee('about.html', false);
});
