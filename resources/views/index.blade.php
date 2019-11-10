<!DOCTYPE html>
<html>
<head>
    <title>Hypertube</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body>

<div id="app">
    <router-view></router-view>
</div>

<script src="{{asset('js/app.js')}}?1273455236"></script>
</body>
</html>
