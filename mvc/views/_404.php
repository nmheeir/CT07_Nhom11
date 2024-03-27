<!doctype html>
<html lang="en">

<head>
    <title>404 | Not Found</title>
    <base href="http://localhost/CT07_Nhom11/" />
    <link rel="stylesheet" href="../CT07_Nhom11/public/css/404.css" />
</head>

<body class="permission_denied">
    <div id="tsparticles"></div>
    <div class="denied__wrapper">
        <h1>404</h1>
        <h3> <? if(isset($data["message"])) echo $data["message"] ?> </h3>
        <h3> 
            Có chắc là truy cập đúng link chưa ?
        </h3>
        <img id="astronaut" src="../CT07_Nhom11/public/upload/astronaut.svg" />
        <img id="planet" src="../CT07_Nhom11/public/upload/planet.svg" />
        <a href="#"><button class="denied__link">Go Home</button></a>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
    <script type="text/javascript" src="js/404.js"></script>
</body>

</html>

<script>
    const particles = {
        fpsLimit: 60,
        particles: {
            number: {
                value: 160,
                density: {
                    enable: true,
                    area: 800,
                },
            },
            color: {
                value: "#ffffff",
            },
            shape: {
                type: "circle",
            },
            opacity: {
                value: 1,
                random: {
                    enable: true,
                    minimumValue: 0.1,
                },
                animation: {
                    enable: true,
                    speed: 1,
                    minimumValue: 0,
                    sync: false,
                },
            },
            size: {
                value: 3,
                random: {
                    enable: true,
                    minimumValue: 1,
                },
            },
            move: {
                enable: true,
                speed: 0.17,
                direction: "none",
                random: true,
                straight: false,
                outModes: {
                    default: "out",
                },
            },
        },
        interactivity: {
            detectsOn: "canvas",
            events: {
                resize: false,
            },
        },
        detectRetina: true,
    };

    tsParticles.load("tsparticles", particles);
</script>