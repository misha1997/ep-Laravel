<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <v-app light v-cloak>
        <snack-bar-component></snack-bar-component>
        <v-toolbar class="white">
            @if (Route::has('login') && ! Auth::check() )
                <login-button-component action="{{ $action ?? null }}" ></login-button-component>
                <remember-password-component action="{{ $action ?? null }}"></remember-password-component>
                <reset-password-component
                        action="{{ $action ?? null }}"
                        token="{{ $token ?? null }}"
                        email="{{ $email ?? null }}"></reset-password-component>
            @endif
        </v-toolbar>
    </v-app>
</div>
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
</body>
</html>