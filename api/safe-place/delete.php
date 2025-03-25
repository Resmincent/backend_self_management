<?php

require "../../connection.php";
require "../response.php";

$id = $_GET['id'];

try {
    // Query untuk mendapatkan file_path sebelum menghapus
    $sql = "SELECT file_path FROM safe_places WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $safePlace = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$safePlace) {
        $responseBody = array("message" => "Not Found");
        sendResponse(404, $responseBody);
        exit;
    }

    // Jika ada file, hapus dari server
    if (!empty($safePlace['file_path']) && file_exists("../../uploads/" . $safePlace['file_path'])) {
        unlink("../../uploads/" . $safePlace['file_path']);
    }

    // Hapus dari database
    $sql = "DELETE FROM safe_places WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $responseBody = array("message" => "Success Delete Data");
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
