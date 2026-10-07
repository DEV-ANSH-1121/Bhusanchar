<!DOCTYPE html>
<html lang="en">
  @include('frontend.layout.head')
  <body>
    @include('frontend.layout.topbar')

    @include('frontend.layout.navbar')

    @yield('content')

    @include('frontend.layout.footer')

    @include('frontend.layout.script')
  </body>
</html>

