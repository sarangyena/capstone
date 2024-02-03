<?php
include ('../../includes/admin/header.php');
?>
                    <div class="container-fluid text-white p-3">
                        <h1 class="border-bottom text-center py-2">HOMEPAGE</h1>
                        <form method="POST" class="d-flex" action="../../private/search_process.php">
                                <div class="input-group">
                                    <span class="input-group-text">SEARCH</span>
                                    <input type="search" class="form-control" name="homepageBar" oninput="up(this)" tabindex="1" required>
                                </div>
                                <div class="input-group mx-2 ">
                                    <label class="input-group-text">FILTER</label>
                                    <select class="form-select" name="homepageFilter" tabindex="2" required>
                                        <option value="" disabled selected></option>
                                        <option value="id">ID</option>
                                        <option value="name">NAME</option>
                                        <option value="job">JOB</option>
                                        <option value="dateIn">DATE-IN</option>
                                        <option value="timeIn">TIME-IN</option>
                                        <option value="dateOut">DATE-OUT</option>
                                        <option value="timeOut">TIME-OUT</option>
                                        <option value="status">STATUS</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning" name="search" tabindex="3">SEARCH</button>
                                <button type="button" class="btn btn-warning ms-2" name="reload" tabindex="4" onclick="reloadPage()"><i class="fa-solid fa-rotate-right"></i></button>
                            </form>
                        <?php
                        dashboard();
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
include ('../../includes/admin/footer.php');
?>