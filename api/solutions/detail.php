<?php

require "../../connection.php";
require "../response.php";

$id = $_GET['id'];

try {
    $sql = "SELECT * FROM solutions WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $solutions = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$solutions) {
        $responseBody = array(
            "message" => "Not Found",
        );
        sendResponse(404, $responseBody);
        return;
    }
    $responseBody = array(
        "message" => "Success Fetch Data",
        "data" => $solutions
    );

    sendResponse(200, $responseBody);
} catch (PDOException $e) {
    $responseBody = array(
        "message" => "Failed Fetch Data",
        "error" => $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
