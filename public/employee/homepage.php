<?php
include ('../../includes/employee/header.php');
?>
                    <div class="container-fluid text-white p-3">
                        <h1 class="border-bottom text-center py-2">HOMEPAGE</h1>
                        <div class="row">
                            <div class="col rounded bg-white d-flex flex-column p-3">
                                <h2 class="text-center text-black border-bottom border-black">TOTAL SALARY</h2>
                                <?php
                                totalSalary();
                                ?>
                            </div>
                            <div class="col rounded bg-white mx-2 d-flex flex-column p-3">
                                <h2 class="text-center text-black border-bottom border-black">ALLOWANCE</h2>
                                <?php
                                allowance();
                                ?>
                            </div>
                            <div class="col rounded bg-white d-flex flex-column p-3">
                                <h2 class="text-center text-black border-bottom border-black">DEDUCTION</h2>
                            </div>
                        </div>
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