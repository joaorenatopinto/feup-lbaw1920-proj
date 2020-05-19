<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>

   <!-- App Javascript -->
    <script type="text/javascript" src={{ asset('js/app.js') }} defer> </script>

    <!-- fontawsome -->
    <script src="https://kit.fontawesome.com/aac9f57b5f.js" crossorigin="anonymous"></script>

  </head>
  <body>
    <main>
      @auth('admin')
        @include('common.adminHeader');
      @endauth

      @guest('admin')
        @include('common.header')
      @endauth

      <section id="content">
        @yield('content')
      </section>

      @include('common.footer')
    </main>
  </body>
</html>
