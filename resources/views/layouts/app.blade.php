<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    @include('layouts.head')
  </head>
  <body>
    <main>
      @include('layouts.header')
    <section id="content">
      @yield('content')
    </section>
    </main>
    @include('layouts.footer')
  </body>
</html>
