<!DOCTYPE html>
<html>
<head>
    <title>My Website</title>
    <!-- Any common CSS, meta tags, or scripts can go here -->
</head>
<body>
    <header>
        <!-- Header content -->
        <h1>Welcome to my website!</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <!-- Other navigation links -->
            </ul>
        </nav>
    </header>

    <main>
        <!-- This is where the page-specific content will be included -->
        <?php
        // This is where the content of the page will be included
        if (isset($content)) {
            echo $content;
        }
        ?>
    </main>

    <footer>
        <!-- Footer content -->
        <p>&copy; <?php echo date("Y"); ?> My Website. All rights reserved.</p>
    </footer>
</body>
</html>
