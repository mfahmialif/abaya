<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('admin') }}/assets/"
  data-template="horizontal-menu-template"
  data-style="light">
  <head>
    @include('layouts.auth.header')
    @stack('css')
</head>

<body>
    @yield('content')
    @include('layouts.auth.scripts')
    @stack('scripts')
  </body>
</html>
