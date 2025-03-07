<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$startDate = $_POST['start_date'];

try {
    $sql = "SELECT 
            SUBSTRING(start_event, 1, 10) AS date, 
            COUNT(*) AS total  
        FROM agendas 
        WHERE 
            user_id = :userId AND start_event >= :startDate 
        GROUP BY date
        ORDER BY date";

    $statement = $conn->prepare($sql);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':startDate', $startDate, PDO::PARAM_STR);
    $statement->execute();

    $agendas = $statement->fetchAll(PDO::FETCH_ASSOC);

    $responseBody = array(
        "message" => "Success Fetch Data",
        "data" => array(
            "agendas" => $agendas,
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
