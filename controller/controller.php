<?php
    $connection = mysqli_connect('localhost', 'user_db', 'pass_db', 'name_db');

    function getUser($username) {
        global $connection;

        $query = "SELECT * FROM users WHERE username='$username'";
        $record = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($record);

        return $user;
    }

    function login($data) {
        $username = $data['username'];
        $password = $data['password'];
        $remember = isset($data['remember']);

        $user = getUser($username);

        if (isset($user)) {
            if (password_verify($password, $user['password'])) {
                if ($remember) {
                    setcookie('id', $user['id'], time() + 86400);
                    setcookie('key', password_hash($user['username'], PASSWORD_DEFAULT), time() + 86400);
                }
                header("Location: index.php");

                return true;
            }
        }

        echo "
            <script>
                alert('Username or Password wrong!')
            </script>
        ";

        return false;
    }

    function upload() {
        $file_name       = $_FILES['cover']['name'];
        $file_size       = $_FILES['cover']['size'];
        $file_error      = $_FILES['cover']['error'];
        $file_tmp        = $_FILES['cover']['tmp_name'];

        // check upload image
        if ($file_error == 4) {
            echo "
                <script>
                     alert('Choose cover!');
                 </script>
             ";
 
             return false;
         }
 
         // check extension file
         $valid_extension = ['jpg', 'jpeg', 'png', 'webp'];
         $temp = explode('.', $file_name);
         $file_extension = strtolower(end($temp));
 
         if (!in_array($file_extension, $valid_extension)) {
             echo "
                 <script>
                     alert('Please upload image file!');
                 </script>
             ";
 
             return false;
         }
 
         // check file size
         if ($file_size > 2000000) {
             echo "
                 <script>
                     alert('Size is too big!');
                 </script>
             ";
 
             return false;
         }

         $file_name = uniqid() . time() . "." . $file_extension;
 
         // if pass uploaded
         move_uploaded_file($file_tmp, '../assets/img/' . $file_name);
 
         return $file_name;
    }

    function query($query) {
        global $connection;
        
        $result = mysqli_query($connection, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    function addBook($data) {
        global $connection;

        $title = $data["title"];
        $author = $data["author"];
        $year = $data["year"];
        $description = $data["description"];
        $cover = upload();
        
        if (!$cover) {
            return false;
        }

        $query = "INSERT INTO books VALUES (
            0, '$title', '$author', '$year', '$description', '$cover'
        );";

        mysqli_query($connection, $query);

        if (mysqli_affected_rows($connection)) {
            echo "
            <script>
                alert('Book added!');
                document.location.href = 'index.php';
            </script>
        ";
        } else {
            echo "
            <script>
                alert('Book fail to added!');
                document.location.href = 'index.php';
            </script>
        ";
        }
    }

    function deleteBook($id) {
        global $connection;

        $data = query("SELECT cover FROM books WHERE id=$id")[0]["cover"];
        unlink('../assets/img/' . $data);


        mysqli_query($connection, "DELETE FROM books WHERE id=$id");

        if (mysqli_affected_rows($connection) > 0) {
            echo "
            <script>
                alert('Book Deleted!');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Fail to delete Book!');
                document.location.href = 'index.php';
            </script>
            ";
        }
    }

    function updateBook($data, $id) {
        global $connection;
        
        $title = $data["title"];
        $author = $data["author"];
        $year = $data["year"];
        $description = $data["description"];

        if ($_FILES['cover']['error'] == 4) {
            $query = "UPDATE books SET 
            title='$title', author='$author', 
            year='$year', description='$description' 
            WHERE id=$id";
        } else {
            $cover = upload();

            $query = "UPDATE books SET 
            title='$title', author='$author', 
            year='$year', description='$description', 
            cover='$cover' WHERE id=$id";

            $old_cover = query("SELECT cover FROM books WHERE id=$id")[0]['cover'];
            unlink('../assets/img/' . $old_cover);
        }

        mysqli_query($connection, $query);

        if (mysqli_affected_rows($connection)) {
            echo "
            <script>
                alert('Book updated!');
                document.location.href = 'index.php';
            </script>
        ";
        } else {
            echo "
            <script>
                alert('Book fail to updated!');
                document.location.href = 'index.php';
            </script>
        ";
        }
    }
