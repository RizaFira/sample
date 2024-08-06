<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPR DSARI BUMI</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .container-fluid {
            flex: 1;
            padding-bottom: 9vh; 
        }
        .row-full-height {
            height: 100%;
        }
        .col-full-height {
            height: 100%;
        }
        .moving-credits-container {
            position: relative;
            overflow: hidden;
            height: 50%; /* Adjust to the height you want for the visible area */
           
        }

        .moving-credits {
            position: absolute;
            animation: moveCredits 10s linear infinite;
            top: 100%;
            font-size: 26px; /
        }

        @keyframes moveCredits {
            0% {
                top: 100%;
            }
            100% {
                top: -100%;
            }
        }

        @keyframes moveCredits {
            0% {
                top: 100%;
            }
            100% {
                top: -100%;
            }
        }

        footer {
            height: 7vh;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
        }
        .moving-text {
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            animation: scroll-left 20s linear infinite;
        }
        @keyframes scroll-left {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
     
        @media (max-width: 767.98px) {
            .row-full-height {
                height: auto;
            }
            .col-full-height {
                height: auto;
            }
            .row {
                margin-bottom: 15px;
            }
        }
        .video-container {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 aspect ratio */
        overflow: hidden;
    }

    .video-container iframe,
    .video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit:contain; /* Ensures the video covers the entire container */
    }
    .carousel-item {
        position: relative;
        width: 100%;
        height: 0;
        padding-top: 56.25%; /* 16:9 aspect ratio */
        overflow: hidden;
    }

    .carousel-item img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain; /* Ensures the entire image fits within the container */
        background-color: #000; /* Optional: Adds a background color for better contrast */
    }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h2 class="text-left mt-3" style="font-size: 40px">BPR SARI BUMI</h2>
        </div>
    </div>
    <div class="row row-full-height">
        <!-- First Block -->
        <div class="col-md-4 col-full-height">
            <div class="row h-50" style="margin-bottom: 5px;">
                <div class="col video-container">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $youtube }}" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="row h-50">
                 <div class="col video-container">
                    <video controls loop>>
                        <source src="{{ route('video', $video) }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>

        <!-- Second Block -->
        <div class="col-md-4 col-full-height">
            <div class="row h-100">
                <div class="col d-flex flex-column">
                    <h2>Suku Bunga</h2>
                    <div class="moving-credits-container">
                        <div class="moving-credits">
                            <p>Deposito</p>
                            <p>Tabungan</p>
                            <p>Kredit</p>
                            <p>LSP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Block -->
        <div class="col-md-4 col-full-height">
            <div class="row h-50">
                <div class="col">
                    <h5 style="font-size: 30px">Suku Bunga</h5>
                    <p>LPS</p>
                </div>
            </div>
            <div class="row h-50">
                <div class="col">
                    <div id="carouselExampleSlidesOnly" class="carousel slide h-100" data-ride="carousel" data-interval="3000">
                        <div class="carousel-inner h-100">
                            @if($images)
                                @foreach($images as $index => $image)
                                    <div class="carousel-item h-100 {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ route('image', $image) }}" class="d-block w-100 h-100 fixed-frame" alt="{{ $image }}">
                                    </div>
                                @endforeach
                            @else
                                <div class="carousel-item h-100 active">
                                    <img src="https://2.img-dpreview.com/files/p/TS1200x900~sample_galleries/6427439680/7522058653.jpg" class="d-block w-100 h-100 fixed-frame" alt="Default Image">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="text-center">
    <div class="col-12">
        @if($footer)
        <div class="moving-text">{{ $footer }}</div>
        @else
        <div class="moving-text">Selamat Datang DiLayana Terpadu Kami</div>
        @endif
    </div>
</footer>
<script>
     $(document).ready(function(){
        $('#carouselExampleSlidesOnly').carousel({
            interval: 3000,
            ride: 'carousel',
            wrap: true
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
