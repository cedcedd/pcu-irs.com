<?php
// Connect to the database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the IDs of the rows to delete
    $ids = isset($_POST['delete']) ? $_POST['delete'] : array();

    // Construct the SQL query to delete the selected rows
    $sql = "DELETE FROM table_name WHERE id IN (" . implode(',', $ids) . ")";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Selected rows deleted successfully";
    } else {
        echo "Error deleting rows: " . $conn->error;
    }
}

// Construct the SQL query to fetch the data for the table
$sql = "SELECT * FROM table_name";
$result = $conn->query($sql);

// Output the table HTML
echo '<form method="POST" id="delete-form">';
echo '<table>';
echo '<thead><tr><th></th><th>ID</th><th>Name</th><th>Age</th></tr></thead>';
echo '<tbody>';
while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td><input type="checkbox" name="delete[]" value="' . $row['id'] . '"></td>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['age'] . '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
echo '<input type="submit" value="Delete selected rows" id="delete-button" disabled>';
echo '</form>';

// Close the database connection
$conn->close();

// Add JavaScript to disable the submit button if no checkboxes are checked
echo '<script>';
echo 'var form = document.getElementById("delete-form");';
echo 'var button = document.getElementById("delete-button");';
echo 'var checkboxes = form.getElementsByTagName("input");';
echo 'for (var i = 0; i < checkboxes.length; i++) {';
echo '    checkboxes[i].addEventListener("change", function() {';
echo '        var checked = false;';
echo '        for (var j = 0; j < checkboxes.length; j++) {';
echo '            if (checkboxes[j].type === "checkbox" && checkboxes[j].checked) {';
echo '                checked = true;';
echo '                break;';
echo '            }';
echo '        }';
echo '        button.disabled = !checked;';
echo '    });';
echo '}';
echo '</script>';
?>