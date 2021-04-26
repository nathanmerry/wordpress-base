<!DOCTYPE html>
<html {{ language_attributes() }}>
  <head>
    <meta charset="{{ get_bloginfo('charset') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700;800&display=swap&family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    {{ wp_head() }}
    <style>
      :root {
        --theme-primary: {{ $theme['color']['primary'] }};
        --theme-tertiary: {{ $theme['color']['tertiary'] }};
        --theme-secondary: {{ $theme['color']['secondary'] }};
        --theme-dark: #1D2545;
      }
      html { margin-top: 0 !important; }
    </style>
  </head>
  <body id="body" class="bg-white">
    @yield('header')
    @yield('body')
    @yield('footer')
    {{ wp_footer() }}
  </body>
</html>
