<?php
    session_start();

    if (!$_SESSION['login']) {
        header('Location: login.php');
        exit;
    }

    require "../controller/controller.php";

    if (isset($_POST['add_book'])) {
        addBook($_POST);
    }

    $books = query("SELECT * FROM books");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - OurBooks</title>
    <link rel="shortcut icon" href="../assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets//css//admin.css">
    <script src="../assets/js/admin.js" defer></script>
</head>
<body>
    <header>
        <img src="../assets/Title.webp"/>
    </header>
    <main id="main-container">
        <div id="jumbo">
            <div id="jumbo-text">
                <h1>Admin - OurBooks</h1>
                <p>Manage Your Books</p>
            </div>
        </div>
            <form class="hide" id="add-book" action="<?php $_PHP_SELF ?>" method="POST" enctype="multipart/form-data">
                <h1>Add Book</h1>
                <div id="form-grid">
                    <div id="left">
                        <div class="input-form">
                            <label for="title">Book Title</label>
                            <input type="text" name="title" id="title" required autocomplete="off">
                        </div>
                        <div class="input-form">
                            <label for="author">Book Author</label>
                            <input type="text" name="author" id="author" autocomplete="off" required>
                        </div>
                        <div class="input-form">
                            <label for="year">Book Year</label>
                            <input type="number" name="year" id="year" autocomplete="off" required min="1800" max="2100">
                        </div>
                        <div class="input-image">
                            <input type="file" name="cover" id="cover">
                        </div>
                    </div>
                    <div id="right">
                        <div class="input-form">
                            <label for="description">Book Description</label>
                            <textarea name="description" id="description" rows="12" required></textarea>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="submit" name="add_book" id="submit" value="Add Book">
                </div>
            </form>
        <div id="list-book">
            <?php foreach($books as $book) : ?>
            <div class="book">
                <div class="book-inner">
                    <div class="book-image">
                        <img src="../assets/img/<?= $book['cover']; ?>" alt="<?= $book['title']; ?>">
                    </div>
                    <div class="book-description">
                        <h2><?= $book['title']; ?></h2>
                        <p><?= $book['description']; ?></p>
                        <p class="author-year"><?= $book['author'], " - ", $book['year']; ?></p>
                        <div class="update-book">
                            <a href="/ourbooks/admin/update.php?id=<?= $book['id']; ?>">Update Book</a>
                        </div>
                        <div class="delete-book">
                            <a href="/ourbooks/admin/delete.php?id=<?= $book['id']; ?>" onclick="return confirm('Sure?')">Delete Book</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div id="menu">
            <div id="menu-item" class="hide">
                <ul>
                    <li><a id="show-add-book" href="#">Add Book</a></li>
                    <li><a href="/ourbooks/admin/logout.php">Logout</a></li>
                </ul>
            </div>
            <div id="btn-menu">
                <svg viewBox="0 0 24 24">
                    <path d="M 5 8 C 7.209 8 9 9.791 9 12 C 9 14.209 7.209 16 5 16 C 2.791 16 1 14.209 1 12 C 1 9.791 2.791 8 5 8 M 12 1 C 14.209 1 16 2.791 16 5 C 16 7.209 14.209 9 12 9 C 9.791 9 8 7.209 8 5 C 8 2.791 9.791 1 12 1 M 12 15 C 14.209 15 16 16.791 16 19 C 16 21.209 14.209 23 12 23 C 9.791 23 8 21.209 8 19 C 8 16.791 9.791 15 12 15 M 19 8 C 21.209 8 23 9.791 23 12 C 23 14.209 21.209 16 19 16 C 16.791 16 15 14.209 15 12 C 15 9.791 16.791 8 19 8 Z" transform="matrix(0.707107, 0.707106, -0.707106, 0.707107, 11.99999, -4.970563)"/>
                </svg>
            </div>
        </div>
    </main>
    <footer>herdianurdin</footer>
</body>
</html>