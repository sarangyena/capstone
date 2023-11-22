<?php
include ('../../includes/admin/header.php');
?>
                    <div class="container-fluid text-white p-3">
                        <h1 class="border-bottom text-center py-2">HOMEPAGE</h1>
                        <div class="row">
                            <div class="col rounded bg-white d-flex flex-column p-3">
                                <h2 class="text-center text-black border-bottom border-black">TOTAL EMPLOYEES</h2>
                                <?php
                                countData();
                                ?>
                            </div>
                            <div class="col rounded bg-white mx-2 d-flex flex-column p-3">
                                <h2 class="text-center text-black border-bottom border-black">ACTIVE</h2>
                            </div>
                            <div class="col rounded bg-white d-flex flex-column p-3">
                                <h2 class="text-center text-black border-bottom border-black">NOT ACTIVE</h2>
                            </div>
                        </div>
                    </div>
                </div>
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
</body>
</html>