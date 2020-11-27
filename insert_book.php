<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Entry Results</title>
</head>
<body>
<h1>Book Entry Results</h1>
<?php

// TODO 1: Create short variable names.
$isbn = '';
$author = '';
$title = '';
$title = '';

// TODO 2: Check and filter data coming from the user.

if (isset($_POST['isbn']) && isset($_POST['author']) && isset($_POST['title']) && isset($_POST['price'])) {
    echo 'test';

    $isbn = htmlspecialchars($_POST['isbn']);
    $author = htmlspecialchars($_POST['author']);
    $title = htmlspecialchars($_POST['title']);
    $price = htmlspecialchars($_POST['price']);


}

// TODO 3: Setup a connection to the appropriate database.


$conn = mysqli_connect('localhost', 'root', '', 'publications');
if ($conn->connect_error) {
    die('Connection failed' . $conn->connect_error);
}

// TODO 4: Query the database.


$result = $conn->query("INSERT INTO catalogs(isbn,author,title,price) VALUES ('$isbn','$author','$title','$price')") or die($conn->error);


// TODO 5: Display the feedback back to user.

if ($result) {
    echo '<p>Book has insert successfully</p>';
}

// TODO 6: Disconnecting from the database.
$conn->close();

?>
</body>
</html>