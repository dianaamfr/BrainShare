<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name','BrainShare') }}</title>

<!-- Bootstrap Css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

<!-- Styles -->
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

<!-- Bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"
        defer></script>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/cf05cece41.js" crossorigin="anonymous"></script>

<!-- Iconify -->
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

<!-- Rich Text -->
<link rel="stylesheet" href="http://lab.lepture.com/editor/editor.css"/>
<script src="https://lab.lepture.com/editor/editor.js" defer></script>
<script src="https://lab.lepture.com/editor/marked.js" defer></script>

<!-- Scripts -->
<script  src={{ asset('js/parseMD.js') }} type="module"></script>
<script  src={{ asset('js/removeMD.js') }} type="module"></script>
<script  src={{ asset('js/search.js') }}  type="module"></script>
<script  src={{ asset('js/tags.js') }} type="module"></script>
<script  src={{ asset('js/courses.js') }} type="module"></script>
<script  src={{ asset('js/upvote.js') }}  type="module"></script>
<script  src={{ asset('js/valid-answer.js') }}  type="module"></script>
<script  src={{ asset('js/notification.js') }} type="module"></script>
<script  src={{ asset('js/imagePreview.js') }} defer></script>
<script  src={{ asset('js/hashchange.js') }} defer></script>
<script  src={{ asset('js/autocomplete.js') }} defer></script>
<script  src={{ asset('js/editor.js') }}  defer></script>


<!-- Library to translate MD to html -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js"
        integrity="sha512-L03kznCrNOfVxOUovR6ESfCz9Gfny7gihUX/huVbQB9zjODtYpxaVtIaAkpetoiyV2eqWbvxMH9fiSv5enX7bw=="
        crossorigin="anonymous"></script>

@yield('scripts')