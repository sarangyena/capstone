<?php
include ('../../includes/employee/header.php');
?>
                    <div class="container-fluid text-white p-3">
                        <h1 class="text-white border-bottom d-inline-block">RECORD</h1>
                        <?php
                        recordEmp();
                        ?>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("record");
                        record.classList.remove('text-black');
                        record.className += " bg-success text-white active";
                    });
                    </script>
<?php
include ('../../includes/employee/footer.php');
?>