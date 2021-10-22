<?php
    require "controller/controller.php";
    $books = query("SELECT * FROM books");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OurBooks</title>
    <link rel="shortcut icon" href="assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <script src="assets/js/home.js" defer></script>
</head>
<body>
    <header>
        <img src="assets/Title.webp"/>
    </header>
    <main id="main-container">
        <div id="jumbo">
            <div id="jumbo-text">
                <h1>Our Book Collection</h1>
                <p>Let's find the book you like</p>
            </div>
        </div>
        <div id="list-book">
        <?php foreach($books as $book) : ?>
            <div class="book">
                <div class="book-inner">
                    <div class="book-image">
                        <img src="assets/img/<?= $book['cover']; ?>" alt="<?= $book['title']; ?>">
                    </div>
                    <div class="book-description">
                        <h2><?= $book['title']; ?></h2>
                        <p><?= $book['description']; ?></p>
                        <p class="author-year"><?= $book['author'], " - ", $book['year']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>herdianurdin</footer>
</body>
</html>
