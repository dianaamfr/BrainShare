<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BrainShare') }}</title>

    <!-- Bootstrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/cf05cece41.js" crossorigin="anonymous"></script>

    <!-- Pagination -->
    <script type="text/javascript" src={{ asset('js/pagination.js') }} defer>

    <!-- Rich Text -->
    <link rel="stylesheet" href="http://lab.lepture.com/editor/editor.css" />
    <script src="https://lab.lepture.com/editor/editor.js" defer></script>
    <script src="https://lab.lepture.com/editor/marked.js" defer></script>
    
    <!-- Scripts -->
    <script type="text/javascript" src={{ asset('js/editor.js') }} defer>
    <script type="text/javascript" src={{ asset('js/parseMD.js') }} defer>
    <script type="text/javascript" src={{ asset('js/removeMD.js') }} defer>

    <!-- Carousel -->
    <!-- <script src="js/homepage-carousel.js" defer></script> -->

    <!-- Library to translate MD to html --> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js" integrity="sha512-L03kznCrNOfVxOUovR6ESfCz9Gfny7gihUX/huVbQB9zjODtYpxaVtIaAkpetoiyV2eqWbvxMH9fiSv5enX7bw==" crossorigin="anonymous"></script> 
    
</script>
  </head>
  <body>
    <main>
    <header>
        <h1><a href="{{ url('/cards') }}">BrainShare!</a></h1>
        @if (Auth::check())
        <a class="button" href="{{ url('/logout') }}"> Logout </a> <span>{{ Auth::user()->name }}</span>
        @endif
    </header>
    <section id="content">
      @yield('content')
    </section>
    </main>
  </body>
</html>
