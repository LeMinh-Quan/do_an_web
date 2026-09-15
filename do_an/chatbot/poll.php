<?php
session_start();
require_once __DIR__ . '/../connect_db.php';

header('Content-Type: application/json; charset=UTF-8');
$conn = connect_db();
$sessionId = session_id();
$lastId = max(0, (int)($_GET['after'] ?? 0));
$stmt = $conn->prepare(
    'SELECT c.chat_mode, m.id, m.sender, m.message
     FROM chatbot_conversations c
     LEFT JOIN chatbot_messages m ON m.conversation_id = c.id AND m.id > ?
     WHERE c.session_id = ? ORDER BY m.id ASC'
);
$stmt->bind_param('is', $lastId, $sessionId);
$stmt->execute();
$result = $stmt->get_result();
$messages = [];
$mode = 'bot';
while ($row = $result->fetch_assoc()) {
    $mode = $row['chat_mode'];
    if ($row['id'] !== null && $row['sender'] !== 'customer') {
        $messages[] = ['id' => (int)$row['id'], 'sender' => $row['sender'], 'message' => $row['message']];
    }
}
$stmt->close();
echo json_encode(['status' => 'success', 'mode' => $mode, 'messages' => $messages], JSON_UNESCAPED_UNICODE);
