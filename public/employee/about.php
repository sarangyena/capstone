<?php
include ('../../includes/employee/header.php');
?>
                    <div class="container-fluid text-white p-3">
                        <h1 class="text-white border-bottom d-inline-block">ABOUT</h1>
                        <img src="../../private/images/about.jpg" class="img-fluid">
                        <img src="../../private/images/about1.jpg"class="img-fluid">
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("about");
                        about.classList.remove('text-black');
                        about.className += " bg-success text-white active";
                    });
                    </script>
<?php
include ('../../includes/employee/footer.php');
?>