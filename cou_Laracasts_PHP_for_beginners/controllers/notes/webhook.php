<?php

use Core\App;
use Core\Database;

// 1. Zdefiniuj URL webhooka
define('WEBHOOK_URL', 'https://marek335-20335.wykr.es/webhook-test/8f1d03e0-56d0-4c09-a69a-ce5815ddc8be'); // <-- PAMIĘTAJ, ABY SPRAWDZIĆ TEN URL I METODĘ (GET/POST)

// 2. Pobierz wszystkie notatki z bazy danych
try {
    $db = App::resolve(Database::class);
    
    $notes = $db->query('SELECT id, body, user_id FROM notes')->get(); // Można jawnie wybrać kolumny

    if (empty($notes)) {
        error_log("Webhook: No notes found to send.");
        echo "Webhook: No notes found to send."; 
        exit;
    }

} catch (Exception $e) {
    error_log("Webhook Error (Database): " . $e->getMessage());
    http_response_code(500); 
    echo "Webhook Error: Could not retrieve notes from database."; 
    exit;
}


// 3. Przygotuj dane do wysłania (np. w formacie JSON)
$formatted_notes_data = [];
foreach ($notes as $note) {
    $title = mb_substr($note['body'], 0, 50, 'UTF-8'); // Pobierz pierwsze 50 znaków jako tytuł
    if (mb_strlen($note['body'], 'UTF-8') > 50) {
        $title .= '...'; // Dodaj wielokropek, jeśli treść jest dłuższa
    }

    $formatted_notes_data[] = [
        'title' => $title,
        'body' => $note['body']
        // Opcjonalnie możesz dodać ID notatki, jeśli odbiorca webhooka go potrzebuje:
        // 'original_note_id' => $note['id'], 
        // 'user_id' => $note['user_id'] 
    ];
}

$payload = json_encode([
    'timestamp' => date('c'), 
    'source' => 'MyNotesApplication',
    'notes_count' => count($notes), // Liczba oryginalnych notatek
    'data' => $formatted_notes_data // Przetworzone dane notatek
]);

if (json_last_error() !== JSON_ERROR_NONE) {
    error_log("Webhook Error (JSON Encode): " . json_last_error_msg());
    http_response_code(500);
    echo "Webhook Error: Could not encode data to JSON.";
    exit;
}

// 4. Wyślij dane do webhooka używając cURL
$ch = curl_init(WEBHOOK_URL);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); // Upewnij się, że webhook oczekuje POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload)
    // 'Authorization: Bearer YOUR_ACCESS_TOKEN'
]);
curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); 

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

// 5. Obsłuż odpowiedź z webhooka
if ($curlError) {
    error_log("Webhook Error (cURL): " . $curlError);
    http_response_code(500); 
    echo "Webhook Error: Failed to send data. cURL error: " . htmlspecialchars($curlError);
} elseif ($httpCode >= 200 && $httpCode < 300) {
    error_log("Webhook: Data successfully sent. Response code: " . $httpCode . ". Response: " . $response);
    echo "Webhook: Data successfully sent to " . WEBHOOK_URL;
} else {
    error_log("Webhook Error: Remote server responded with HTTP code " . $httpCode . ". Response: " . $response);
    http_response_code(502); 
    echo "Webhook Error: Remote server responded with HTTP code " . htmlspecialchars($httpCode) . ". Response: " . htmlspecialchars($response);
}

exit;
?>
