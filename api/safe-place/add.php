<?php

require "../../connection.php";
require "../response.php";

$userId = $_POST['user_id'];
$type = $_POST['type']; // 'journal' atau 'audio'
$title = isset($_POST['title']) ? $_POST['title'] : null;
$content = isset($_POST['content']) ? $_POST['content'] : null;

try {
    // Validasi tipe
    if (!in_array($type, ['journal', 'audio'])) {
        sendResponse(400, ["message" => "Invalid type. Must be 'journal' or 'audio'."]);
        exit;
    }

    // Validasi input untuk journal
    if ($type == 'journal' && (empty($title) || empty($content))) {
        sendResponse(400, ["message" => "Title and content are required for journal type."]);
        exit;
    }

    // Query Insert
    $sql = "INSERT INTO safe_places (user_id, type, title, content) 
            VALUES (:user_id, :type, :title, :content)";

    $statement = $conn->prepare($sql);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':type', $type, PDO::PARAM_STR);
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':content', $content, PDO::PARAM_STR);
    $statement->execute();

    // Berhasil menambahkan
    sendResponse(201, ["message" => "Safe Place added successfully"]);
} catch (PDOException $e) {
    sendResponse(500, ["message" => "Something went wrong", "error" => $e->getMessage()]);
} finally {
    $conn = null;
}
