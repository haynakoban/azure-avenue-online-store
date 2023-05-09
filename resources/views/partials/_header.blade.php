<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Azure Avenue</title>
    <script src="//unpkg.com/alpinejs"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');

      *,
      *::before,
      ::after {
        font-family: 'Lato', 'Roboto', 'Poppins', Georgia, 'Times New Roman', Times, serif;
      }

      html {
        scroll-behavior: smooth;
      }

      hr {
        margin: 0 !important;
      }

      #pagination > nav > div:last-child {
        width: 100% !important;
      }
    </style>
</head>
<body>