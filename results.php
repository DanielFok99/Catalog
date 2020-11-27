<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search Results</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<h1>Book Search Results</h1>
<?php
// TODO 1: Create short variable names.
$searchType = '';
$searchTerm = '';


// TODO 2: Check and filter data coming from the user.

if (
    isset($_POST['searchtype']) && !empty(trim($_POST['searchtype'])) &&
    isset($_POST['searchterm']) && !empty(trim($_POST['searchterm']))
) {

    switch (htmlspecialchars(trim($_POST['searchtype']))) {
        case 'author':
            $searchType = 'author';
            break;
        case 'title':
            $searchType = 'title';
            break;
        case 'isbn':
            $searchType = 'isbn';
            break;
    }

    $searchTerm = htmlspecialchars(trim($_POST['searchterm']));

    // TODO 3: Setup a connection to the appropriate database.
    $conn = mysqli_connect('localhost', 'root', '', 'publications');
    if ($conn->connect_error) {
        die('Connection failed' . $conn->connect_error);
    }

    // TODO 4: Query the database.

    $query = "SELECT * FROM catalogs WHERE $searchType LIKE '%$searchTerm%'";
    $result = $conn->query($query);

    // TODO 5: Retrieve the results.
    // TODO 6: Display the results back to user.

    if ($result->num_rows > 0) {
        echo '<table>
                <thead>
                <tr>
                    <th scope="col">ISBN</th>
                    <th scope="col">Author</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                </tr>
                </thead>
                <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo '<td>' . $row['isbn'] . '</td>';
            echo '<td>' . $row['author'] . '</td>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo "</tr>";
        }
        echo '  </tbody>
              </table>';
    } else {
        echo 'No result';
    }


    $conn->close();


    // TODO 7: Disconnecting from the database.

} else {
    echo '<p>Search failed, Please provide require information</p>';
}
?>
</body>
</html>