<?php

require "../../connection.php";
require "../response.php";

$id = $_GET['id'];

try {
    $sql = "SELECT * FROM journals WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $journals = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$journals) {
        $responseBody = array(
            "message" => "Not Found",
        );
        sendResponse(404, $responseBody);
        return;
    }
    $responseBody = array(
        "message" => "Success Fetch Data",
        "data" => $journals
    );
} catch (PDOException $th) {
    $responseBody = array(
        "message" => "Failed Fetch Data",
        "error" => $th->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
    sendResponse(200, $responseBody);
}
