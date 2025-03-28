<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$category = $_POST['category'];
$title = $_POST['title'];
$journalDate = $_POST['journal_date'];
$content = $_POST['content'];


try {
    $sql = "INSERT INTO journals
                (user_id, category, title, journal_date, content)
                VALUES
                ('$userId', '$category', '$title', '$journalDate', '$content')
                ";

    $conn->exec($sql);
    $responseBody = array(
        "message" => "Success add journals",
    );

    sendResponse(201, $responseBody);
} catch (PDOException $e) {
    $responseBody =  array(
        "message" => "Failed add journals",
        "error" =>  $e->getMessage(),
    );
    sendResponse(500, $responseBody);
} finally {
    $conn = null;
}
