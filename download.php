<?php
define("DBNAME", "health");
define("DBUSER", "root");
define("DBPASS", "");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    echo "ID received: $id<br>"; // Debugging line

    try {
        $conn = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSER, DBPASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Database connection established.<br>"; // Debugging line

        $stmt = $conn->prepare("SELECT cv FROM applications WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        echo "Query executed.<br>"; // Debugging line

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $cv = $row['cv'];
            echo "CV fetched from database.<br>"; // Debugging line

            header('Content-Type: application/pdf'); // Adjust MIME type if necessary
            header('Content-Disposition: inline; filename="cv.pdf"');
            echo $cv;
        } else {
            echo "No CV found for the provided ID.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid request. ID parameter is missing.";
}
?>
