<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Ld7urUUAAAAAN5F0dbUxJQoca738QMvo-COgEcA"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6Ld7urUUAAAAAN5F0dbUxJQoca738QMvo-COgEcA', {action: 'homepage'});
        });
    </script>
    <script>
        $(document).ready(function() {
            $("button").click(function (e) {
                e.preventDefault();
                grecaptcha.execute('6Ld7urUUAAAAAN5F0dbUxJQoca738QMvo-COgEcA', {action: 'click'}).then(function (token) {
                    alert(token);
                    var input = $("<input>").attr("type", "hidden").attr("name", "g-recaptcha-response").val(token);
                    $('#registerForm').append(input);
                    $( "#registerForm" ).submit();
                });
            });
        });

    </script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            padding-bottom: 100px;
        }

        .level {
            display: flex;
            align-items: center;
        }

        .flex {
            flex: 1;
        }
    </style>
</head>
<body>
<div id="app">
    @include('layouts.nav')

    <main class="py-4">
        @yield('content')
        <flash message="some message"></flash>
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
