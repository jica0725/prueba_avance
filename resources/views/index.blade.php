@php
$config = [
    'appName' => config('app.name'),
    'locale' => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
    'githubAuth' => config('services.github.client_id'),
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ config('app.name') }}</title>

  <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
  <link rel="stylesheet" href="/fontello/css/fontello.css">
<body>
  <div id="app"></div>

  {{-- Global configuration object --}}
  <script>
    window.config = @json($config);
  </script>

  {{-- Load the application scripts --}}
  <script lang="javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
  {{-- <script lang="javascript" src="/dflip/js/libs/jquery.min.js" ></script> --}}
  <script lang="javascript" src="/dflip/js/dflip.min.js"></script>
  <script lang="javascript" src="/js-xlsx-master/dist/xlsx.full.min.js"></script>
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script> --}}
  <script src="https://sdk.amazonaws.com/js/aws-sdk-2.410.0.min.js"></script>
  <script src="{{ mix('dist/js/app.js') }}"></script>
</body>
</html>
