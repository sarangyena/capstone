<?php
include ('../../includes/employee/header.php');
?>
                    <div class="container-fluid text-white p-3">
                        <h1 class="text-white border-bottom d-inline-block">SALARY REPORT</h1>
                        <?php
                        $username1 = $_SESSION['user_id'];
                        payrollEmp($username1);
                        ?>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("report");
                        report.classList.remove('text-black');
                        report.className += " bg-success text-white active";
                    });
                    </script>
<?php
include ('../../includes/employee/footer.php');
?>