<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-wide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('admin') }}/assets/"
  data-template="front-pages"
  data-style="light">
  <head>
    @include('layouts.home.header')

    @stack('css')
</head>

<body>

    @include('layouts.home.dropdown-script')
    @include('layouts.home.navbar')
    @yield('content')
    @include('layouts.home.scripts')
    @include('layouts.home.footer')

    @stack('scripts')
  </body>
</html>
