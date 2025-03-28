<?php

require "../../connection.php";
require "../response.php";

$id = $_GET['id'];

try {
    $sql = "DELETE FROM journals WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    if ($statement->rowCount() === 0) {
        $responseBody = array(
            "message" => "Not Found",
        );
        sendResponse(404, $responseBody);
        exit;
    }

    $responseBody = array(
        "message" => "Success Delete Data",
    );

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
