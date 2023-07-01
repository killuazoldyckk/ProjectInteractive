<?php
// Menghubungkan ke database (ganti dengan kredensial database Anda)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "family";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

$sql = "SELECT id, name, sound, pronounce FROM familyMember";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('/images/familyBg.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .top-icon{
            display: flex;
            flex-direction: row;
            margin: 1rem;
            width: 100%;
        }

        .top-icon img{
            cursor: pointer;
        }

        .top-icon .backIcon{
            width: 5rem;
            margin-right: 1rem;
            margin-left: 0.5rem;
        }

        .top-icon .soundIcon{
            width: 4.5rem;
            height: 4.9rem;
        }

        .top-icon .menuIcon{
            margin-right: 1rem ;
            height: 4rem;
            margin-left: auto;
            width: 4rem;
        }

        .content{
            border-radius: 1rem;
            text-align: center;
            background-color: #e67171;
        }

        .content img{
            width: 17rem;
            margin: 2rem;
        }

        .content p{
            background-color: #ffc644;
            font-family: 'DM Sans', sans-serif;
            font-size: 1.5rem;
            padding: 0.5rem;
        }

        .content p:hover , .content .pron:hover{
            background-color: #f8b61e;
        }

        .content p i{
            margin-right: 0.5rem ;
        }

        .content .arabic{
            background-color: #f8b61e;
        }

        .content .arabic:hover{
            background-color: #ffc644;
        }


        .bot-icon{
            position: absolute;
            bottom: 0;
            right: 0;
            cursor: pointer;
        }

        .bot-icon img{
            width: 10rem;
            margin: 2rem;
        }
        
    </style>
</head>
<body>
    <audio  id="background-music"" autoplay loop>
        <source src="/audio/Garden.mp3" type="audio/mp3">
        Your browser does not support the audio element.
    </audio>      
    <div class="top-icon">
        <img class="backIcon" src="/images/icon/back.png" id="backButton">
        <img class="soundIcon" src="/images/icon/soundOn.png" title="On/Off Music" id="audio-control" alt="Play" onclick="toggleAudio()">
        <img class="menuIcon" src="/images/icon/menu.png" alt="">
    </div>
    <div class="bot-icon">
        <a href="content.html"><img src="/images/icon/next.png" alt=""></a>
    </div>
    <div class="content">
        <img src="/images/family/father.png" alt="">
        <p>
            <i class="fas fa-volume-up"></i>
            Play Sound
        </p>
        <p class="arabic">
            أب
        </p>
        <p class="pron">
            'Eb
        </p>
    </div>

    <script>
        function getNextData() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    showData(data);
                } else {
                    console.error('Terjadi kesalahan: ' + xhr.status);
                }
            }
        };
        xhr.open('GET', 'get_next_data.php', true);
        xhr.send();

        var audio = document.getElementById("background-music");
        var audioControl = document.getElementById("audio-control");
        const clickSound = document.getElementById("clickSound");

        function toggleAudio() {
        if (audio.paused) {
            audio.play();
            audioControl.src = "/images/icon/soundOn.png"; // Mengganti gambar dengan ikon pause
        } else {
            audio.pause();
            audioControl.src = "/images/icon/soundMute.png"; // Mengganti gambar dengan ikon play
        }
        }

        const backButton = document.getElementById("backButton");
  
        backButton.addEventListener("click", function() {
            history.back();
            clickSound.play();
        });
    }
    </script>
</body>
</html>