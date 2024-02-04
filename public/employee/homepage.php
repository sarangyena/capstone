<?php
include ('../../includes/employee/header.php');
?>
                    <div class="container-fluid text-white p-3">
                        <h1 class="border-bottom text-center py-2">HOMEPAGE</h1>
                        <div class="row">
                            <div class="col bg-white border border-black rounded-2 text-black"> 
                                <h3 class="text-center text-underline">TOTAL SALARY</h3>
                            </div>
                            <div class="col bg-white border border-black mx-2 rounded-2 text-black">
                                asdasda
                            </div>
                            <div class="col bg-white border border-black rounded-2 text-black" style="height: 100px;">
                                asdasdasd
                            </div>

                        </div>
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