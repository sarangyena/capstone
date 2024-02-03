<?php
include ('../../includes/employee/header.php');
?>
                    <div class="container-fluid text-white p-3">
                        <h1 class="border-bottom text-center py-2">HOMEPAGE</h1>
                        <?php
                        $username = $_SESSION['user_id'];
                        empDashboard($username);
                        ?>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("homepage");
                        homepage.classList.remove('text-black');
                        homepage.className += " bg-success text-white active";
                    });
                    </script>
<?php
include ('../../includes/employee/footer.php');
?>