<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$query = $_POST['query'];

try {

    $sql = "SELECT * FROM journals
            WHERE
            user_id = :userId
            AND (
                category LIKE :query OR
                title LIKE :query OR
                journal_date LIKE :query OR
                content LIKE :query
            )";

    $statement = $conn->prepare($sql);
    $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
    $statement->bindValue(':query', "%$query%", PDO::PARAM_STR);
    $statement->execute();

    $journals = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!$journals) {
        $responseBody = array(
            "message" => "Not Found",
        );
        sendResponse(404, $responseBody);
        return;
    }

    $responseBody = array(
        "message" => "Success Fetch Data",
        "data" => array(
            "journals" => $journals,
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
