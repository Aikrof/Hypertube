<!DOCTYPE html>
<html>
<head>
    <title>Hypertube</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/landing.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<style type="text/css">
    .bg{
        background: url('img/cover_image.jpeg') no-repeat center center fixed;
        background-size:cover;
        background-size: cover;
        width: 100vw;
        height: 100vh;
        margin: 0;
        padding: 0;
    }
    .landing_content{
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.6);
    }
    .container{
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<body>
<div class="container-fluid bg" id="app">
    <div class="landing_content">
        <div class="container">
            <auth-component></auth-component>
        </div>
    </div>
</div>

<script src="{{asset('js/app.js')}}?1273455236"></script>
</body>
</html>
