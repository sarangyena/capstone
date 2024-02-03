<?php
session_start();
require ('../private/database.php');
require ('../private/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYROLL SYSTEM</title>
    <link rel="icon" type="image/x-icon" href="../private/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/8.2.3/adapter.js" integrity="sha512-5GyZ48Qlput2gPWmhDnM+0gwdevZnIiChRr64WyR109Ad20B5xG0iLk3h8CqsOdrGL9u52BROuduhdEjwyDJuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.10/vue.cjs.min.js" integrity="sha512-0iiTIkY3h448LMfv6vcOAgwsnSIQ4QYgSyAbyWDtqrig7Xc8PAukJjyXCeYxVGncMyIbd6feVBRwoRayeEvmJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="../private/styles.css">
    <script text="text/javascript" src="../private/script.js"></script>
</head>
<body>
    <div class="bg-success d-flex flex-column" style="height: 100vh;">
        <nav class="navbar bg-success-subtle d-flex flex-column">
            <div class="container-fluid">
                <a class="navbar-brand" href="homepage.php">
                <img src="../private/images/logo.png" alt="Logo" class="img-fluid d-inline-block" style="width: 8%;">
                <h4 class="d-inline-block">AL DA'WAH PRODUCERS COOPERATIVE</h4>
                </a>
            </div>
        </nav>
        <div class="container-fluid mt-3">
            <h1 class="text-white border-bottom d-inline-block">SESSION</h1>
            <div class="row">
                <div class="col-sm">
                    <video id="preview" class="img-fluid mx-auto d-block" style="width: 100%;"></video>
                    <?php
                    if(isset($_SESSION['success'])){
                        echo '<div class="alert alert-success mt-3" role="alert">
                        Successfully recorded.
                    </div>';
                    unset($_SESSION['success']);
                    }
                    ?>
                </div>
                <div class="col-sm-8">
                    <div class="alert alert-info" role="alert">
                        <h4 id="date"></h4>
                    </div>
                    <div class="alert alert-info" role="alert">
                        <h4 id="time"></h4>
                    </div>
                    <h3 class="text-white border-bottom d-inline-block">SCAN QR CODE:</h3>
                    <div class="form-floating">
                        <input type="text" name="username" id="username" class="form-control" placeholder="USERNAME" readonly>
                        <label for="username" class="form-label">ID NUMBER:</label>
                    </div>
                    <?php
                    if(isset($_SESSION['in'])){
                        echo '<div class="alert alert-success mt-2" id="in" role="alert" hidden>
                        Successfully timed-in.
                    </div>';
                    }else if(isset($_SESSION['out'])){
                        echo '<div class="alert alert-success mt-2" id="out" role="alert" hidden>
                        Successfully timed-out.
                    </div>';
                    }
                    ?>
                </div>
            </div>
            <div class="container-fluid">
                <h1 class="text-white border-bottom d-inline-block">LOG REPORT</h1>
                <?php
                logTable();
                ?>
            </div>
            </div>
        </div>
        <div id="location">
        </div>
    </div>
    <script>
        timeDate();
        setInterval(timeDate, 1000);
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            }else{
                alert('No Cameras Found.');
            }
        }).catch(function(e){
            console.error(e);
        });

        scanner.addListener('scan',function(c){
            navigator.geolocation.getCurrentPosition((position) => {
                var obj = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                }
                document.getElementById('username').value=c;
                obj.user = c;

                fetch('../private/scanQR_process.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'                            
                    },
                    body: JSON.stringify(obj)
                })
                .then(data => {
                    // Handle the response data if needed
                    console.log(data);
                    // Redirect to another page using JavaScript
                    window.location.href = '/capstone/log/index.php';
                })

                .catch(error => {
                    console.error('Error:', error);
                });
            })
            
        });
    </script>
</body>
</html>