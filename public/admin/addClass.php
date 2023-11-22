<?php
include ('../../includes/admin/header.php');
?>

                    <div class="container-fluid p-3">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active bg-secondary" href="addEmp.php">ADD EMPLOYEE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active text-black bg-warning mx-2" href="addClass.php">ADD CLASS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active bg-secondary" href="viewEmp.php">EMPLOYEE DETAILS</a>
                            </li>
                        </ul>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("employee");
                        employee.classList.remove('text-black');
                        employee.className += " bg-success text-white active";
                    });
                    </script>
<?php
include ('../../includes/admin/footer.php');
?>