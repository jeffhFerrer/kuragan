<link rel="stylesheet" href="estilo/css/video.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="container">
    <div id="video-container">
        <video id="video">
            <source src="uploads/SampleVideo_360x240_30mb.mp4" type="video/mp4">
            Seu navegador não suporta o elemento de vídeo.
        </video>

        <div class="custom-controls-2">
            <button class="custom-button" id="play-pause-button"><i class="fas fa-play"></i></button>
            <div class="volume-touch-area up"></div>
            <div class="volume-touch-area down"></div>
        </div>
        <div class="custom-controls">
            <span id="timer">0:00 / 0:00</span>
            <button class="custom-button" id="skip-back-button"><i class="fas fa-backward"></i></button>
            <button class="custom-button" id="restart-button"><i class="fas fa-redo-alt"></i></button>
            <button class="custom-button" id="skip-forward-button"><i class="fas fa-forward"></i></button>
            <button class="custom-button" id="mute-button"><i class="fas fa-volume-up"></i></button>
            <span id="volume-value">100%</span>
            <button id="fullscreen-button">
                <i class="fas fa-expand" style="margin-right:10px;"></i>
                fullscreen
            </button>

            <div class="progress-bar-container">
                <progress id="progress" value="0" max="100"></progress>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <a class="col-md-4 tag-a-style">
            <div class="video-card hover">
                <img src="https://via.placeholder.com/300x200?text=Vídeo+1" alt="Vídeo 1">
                <h3 class="video-title">Título do Vídeo 1</h3>
            </div>
        </a>
        <a class="col-md-4 tag-a-style">
            <div class="video-card hover">
                <img src="https://via.placeholder.com/300x200?text=Vídeo+2" alt="Vídeo 2">
                <h3 class="video-title">Título do Vídeo 2</h3>
            </div>
        </a>
        <a class="col-md-4 tag-a-style">
            <div class="video-card hover">
                <img src="https://via.placeholder.com/300x200?text=Vídeo+3" alt="Vídeo 3">
                <h3 class="video-title">Título do Vídeo 3</h3>
            </div>
        </a>
        <a class="col-md-4 tag-a-style">
            <div class="video-card hover">
                <img src="https://via.placeholder.com/300x200?text=Vídeo+4" alt="Vídeo 4">
                <h3 class="video-title">Título do Vídeo 4</h3>
            </div>
        </a>
    </div>
</div>
<script src="estilo/script/script.js"></script>
