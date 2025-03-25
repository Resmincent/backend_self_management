<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];

try {
    // Query untuk mengambil semua data Safe Place berdasarkan user_id
    $sql = "SELECT id, type, title, content, file_path, created_at FROM safe_places 
            WHERE user_id = :user_id
            ORDER BY created_at DESC";

    $statement = $conn->prepare($sql);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $safePlaces = $statement->fetchAll(PDO::FETCH_ASSOC);

    $responseBody = array(
        "message" => "Success Fetch Data",
        "data" => array(
            "safe_places" => $safePlaces,
        )
    );

    sendResponse(200, $responseBody);
} catch (PDOException $e) {
    $responseBody = array(
        "message" => "Something went wrong",
        "error" => $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
