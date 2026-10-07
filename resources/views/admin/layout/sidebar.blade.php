<aside data-sidebar class="fixed inset-y-0 left-0 z-40 flex w-72 flex-col bg-navy text-white transition-transform duration-200 lg:static lg:translate-x-0">
    <div class="flex h-16 items-center gap-3 border-b border-white/10 px-5">
        <img src="{{ asset('frontend/media/logo-cropped.png') }}" alt="BhuSanchar" class="h-9 w-9 rounded-lg bg-white object-contain p-0.5">
        <div>
            <p class="text-sm font-semibold tracking-wide">BhuSanchar</p>
            <p class="text-xs text-white/60">Control Panel</p>
        </div>
    </div>

    <nav class="flex min-h-0 flex-1 flex-col gap-1 overflow-y-auto p-4">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-brand text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-9.5Z" />
            </svg>
            Dashboard
        </a>
        @php
            $catalogOpen = request()->routeIs('admin.products.*', 'admin.categories.*', 'admin.crops.*', 'admin.packagings.*');
        @endphp
        <div data-nav-group @class(['open' => $catalogOpen])>
            <button type="button" data-nav-group-toggle class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ $catalogOpen ? 'bg-white/10 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5h-16.5m16.5 0v9.75A2.25 2.25 0 0 1 18 19.5H6a2.25 2.25 0 0 1-2.25-2.25V7.5m16.5 0-3.18-3.18A2.25 2.25 0 0 0 15.477 3.75H8.522a2.25 2.25 0 0 0-1.591.659L3.75 7.5m12.75 4.5a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm-6.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                <span class="flex-1 text-left">Products</span>
                <svg data-nav-chevron class="h-4 w-4 shrink-0 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                </svg>
            </button>
            <div data-nav-group-panel class="mt-1 ml-4 flex flex-col gap-1 border-l border-white/10 pl-3">
                <a href="{{ route('admin.products.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'bg-brand text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">All products</a>
                <a href="{{ route('admin.categories.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.categories.*') ? 'bg-brand text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">Categories</a>
                <a href="{{ route('admin.crops.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.crops.*') ? 'bg-brand text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">Crops</a>
                <a href="{{ route('admin.packagings.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.packagings.*') ? 'bg-brand text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">Packaging</a>
            </div>
        </div>
        @php
            $enquiryOpen = request()->routeIs('admin.contact-enquiries.*', 'admin.farmer-help-cards.*', 'admin.stock-point-applications.*', 'admin.career-applications.*');
        @endphp
        <div data-nav-group @class(['open' => $enquiryOpen])>
            <button type="button" data-nav-group-toggle class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ $enquiryOpen ? 'bg-white/10 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <span class="flex-1 text-left">Enquiries</span>
                <svg data-nav-chevron class="h-4 w-4 shrink-0 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                </svg>
            </button>
            <div data-nav-group-panel class="mt-1 ml-4 flex flex-col gap-1 border-l border-white/10 pl-3">
                <a href="{{ route('admin.contact-enquiries.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.contact-enquiries.*') ? 'bg-brand text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">Contact Us</a>
                <a href="{{ route('admin.farmer-help-cards.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.farmer-help-cards.*') ? 'bg-brand text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">Farmer Help Card</a>
                <a href="{{ route('admin.stock-point-applications.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.stock-point-applications.*') ? 'bg-brand text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">Stock Point</a>
                <a href="{{ route('admin.career-applications.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.career-applications.*') ? 'bg-brand text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">Career</a>
            </div>
        </div>
        <a href="{{ route('admin.careers.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('admin.careers.*') ? 'bg-brand text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
            Careers
        </a>
        <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('admin.profile.*') ? 'bg-brand text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 19.5a7.5 7.5 0 0 1 15 0" />
            </svg>
            Profile
        </a>
    </nav>

    <div class="border-t border-white/10 p-4">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-white/80 hover:bg-white/10 hover:text-white">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H9" />
                </svg>
                Sign out
            </button>
        </form>
    </div>
</aside>
