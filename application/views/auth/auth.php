<head>
    <meta charset="UTF-8">
    <title>Sign in/up Form</title>
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <style>
        #backButton {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .overlay {
            background-image: url("<?php echo base_url() ?>/assets/img/image2.gif");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            outline-width: 3px;
            outline-style: solid;
            outline-color: black;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="container" id="container">
        <?php include(__DIR__ . '/form_login.php');
        ?>
        <?php

        include(__DIR__ . '/form_register.php');
        ?>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>
                        Lakukan login sebelum kamu melanjutkan penggunaan aplikasi ini
                    </p>
                    <button class="ghost" id="tes2">Login</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Lakukan registrasi akun jika kamu belum mempunyai akun</p>
                    <button class="ghost" id="tes">Register</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>/assets/js/script.js"></script>
</body>