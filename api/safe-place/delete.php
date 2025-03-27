<?php

require "../../connection.php";
require "../response.php";

$id = $_GET['id'];

try {
    // Hapus dari database
    $sql = "DELETE FROM safe_places WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $responseBody = array("message" => "Success Delete Data");
    sendResponse(200, $responseBody);
} catch (PDOException $e) {
    $responseBody = array(
        "message" => "Failed Delete Data",
        "error" => $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
