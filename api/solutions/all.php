<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];

try {
    $sql = "SELECT id, summary, problem, solution, reference FROM solutions 
                    WHERE 
                    user_id = '$userId' 
                    ORDER BY problem
                    ";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $solutions = $statement->fetchAll(PDO::FETCH_ASSOC);

    $responseBody = array(
        "message" => "Success Fetch Data",
        "data" => array(
            "solutions" => $solutions,
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
