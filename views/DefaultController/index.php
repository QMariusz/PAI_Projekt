<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>
<link type="text/css" rel="stylesheet" href="../../style.css"/>

<body>

    <div class="header">

            <!-- Logo -->
            <div id="logoo">
                <a class="logo" href="index.php">
<!--                    TODO dodać image-->
                    <img src="../../public/img/logo.jpg" alt="logo" width="150px" height="100px">
                </a>
            </div>
            <!-- /Logo -->

        <!-- Navigation -->
        <div id="hyperlinks">
            <ul class="main-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="contact.html">Contact</a></li>
</ul>
        </div>
        <!-- /Navigation -->

    </div>

<?php
if(isset($_SESSION) && !empty($_SESSION)) {
    print_r($_SESSION);
}
?>
</body>
</html>