<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];

try {
    $sql = "SELECT id, category, title, journal_date, content FROM journals
                    WHERE
                    user_id = '$userId'
                    ORDER BY title
                    ";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $journals = $statement->fetchAll(PDO::FETCH_ASSOC);

    $responseBody = array(
        "message" => "Success Fetch Data",
        "data" => array(
            "journals" => $journals,
        )
    );

    sendResponse(200, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Something went wrong",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
