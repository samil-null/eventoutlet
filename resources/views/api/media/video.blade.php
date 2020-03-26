<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Video</title>
</head>
<body>
<div id="app">
    <player class="video-player"
        video-src="{{ $url }}"
    ></player>
</div>
<style>
    body {
        margin: 0;
        padding: 0;
        background: #000;
    }
    .video-player #vjs_video_3{
        height: 100vh;
        width:100vw;
    }
</style>
<script src="{{ asset('js/api/video/index.js') }}"></script>
</body>
</html>
