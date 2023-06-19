<?php
include('connection/conn.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the IDs of the rows to delete
    $product_id = isset($_POST['delete']) ? $_POST['delete'] : array();

    // Construct the SQL query to delete the selected rows
    $sql = "DELETE FROM products WHERE product_id IN (" . implode(',', $product_id) . ")";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Selected rows deleted successfully";
    } else {
        echo "Error deleting rows: " . $conn->error;
    }
}

// Construct the SQL query to fetch the data for the table
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Output the table HTML
echo '<form method="POST" id="delete-form">';
echo '<table>';
echo '<thead><tr><th></th><th>Product ID</th><th>Name</th><th>Quantity</th></tr></thead>';
echo '<tbody>';
while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td><input type="checkbox" name="delete[]" value="' . $row['product_id'] . '"></td>';
    echo '<td>' . $row['product_id'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['quantity'] . '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
echo '<input type="submit" value="Delete selected rows"  id="delete-button" disabled>';
echo '</form>';

// Close the database connection
$conn->close();
// Add JavaScript to disable the submit button if no checkboxes are checked
?>
<script>
var form = document.getElementById("delete-form");
var button = document.getElementById("delete-button");
var checkboxes = form.getElementsByTagName("input");
for (var i = 0; i < checkboxes.length; i++) {
   checkboxes[i].addEventListener("change", function() {
       var checked = false;
        for (var j = 0; j < checkboxes.length; j++) {
            if (checkboxes[j].type === "checkbox" && checkboxes[j].checked) {
                checked = true;
               break;
            }
        }
        button.disabled = !checked;
    });
}
</script>