<?php

function normalizeChatText(string $text): string
{
    $text = function_exists('mb_strtolower') ? mb_strtolower($text, 'UTF-8') : strtolower($text);
    $text = (string)preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text);
    return trim((string)preg_replace('/\s+/', ' ', $text));
}

function loadChatbotTrainingData(mysqli $conn): array
{
    $result = $conn->query(
        'SELECT intent, question, reply
         FROM chatbot_training
         WHERE status = 1
         ORDER BY id ASC'
    );
    if ($result === false) {
        throw new RuntimeException('Không thể đọc dữ liệu huấn luyện chatbot từ database.');
    }

    $data = ['samples' => [], 'replies' => [], 'repliesByQuestion' => []];
    while ($row = $result->fetch_assoc()) {
        $intent = trim((string)$row['intent']);
        $question = trim((string)$row['question']);
        if ($intent === '' || $question === '') {
            continue;
        }

        $data['samples'][$intent][] = $question;
        $reply = trim((string)($row['reply'] ?? ''));
        $normalizedQuestion = normalizeChatText($question);
        if ($reply !== '' && !isset($data['repliesByQuestion'][$normalizedQuestion])) {
            $data['repliesByQuestion'][$normalizedQuestion] = $reply;
        }
        if ($reply !== '' && !isset($data['replies'][$intent])) {
            $data['replies'][$intent] = $reply;
        }
    }
    $result->free();

    return $data;
}

function detectChatIntent(string $question, array $trainingData): ?string
{
    $question = normalizeChatText($question);
    if ($question === '') {
        return null;
    }

    $bestIntent = null;
    $bestScore = 0.0;
    $questionWords = array_values(array_unique(explode(' ', $question)));

    foreach ($trainingData as $intent => $samples) {
        if (!is_array($samples)) {
            continue;
        }

        foreach ($samples as $sample) {
            if (!is_string($sample) || $sample === '') {
                continue;
            }

            $sample = normalizeChatText($sample);
            if ($sample === '') {
                continue;
            }
            if ($question === $sample || strpos($question, $sample) !== false) {
                return $intent;
            }

            $sampleWords = array_values(array_unique(explode(' ', $sample)));
            $commonWords = count(array_intersect($questionWords, $sampleWords));
            $wordScore = ($commonWords / max(count($sampleWords), 1)) * 100;
            similar_text($question, $sample, $textScore);
            $score = max($wordScore, $textScore);
            if ($score > $bestScore) {
                $bestScore = $score;
                $bestIntent = $intent;
            }
        }
    }

    return $bestScore >= 60 ? $bestIntent : null;
}

function getChatIntentReply(string $intent, array $trainingData): ?string
{
    $reply = $trainingData['replies'][$intent] ?? null;
    return is_string($reply) && $reply !== '' ? $reply : null;
}

function getChatQuestionReply(string $question, array $trainingData): ?string
{
    $normalizedQuestion = normalizeChatText($question);
    $reply = $trainingData['repliesByQuestion'][$normalizedQuestion] ?? null;
    return is_string($reply) && $reply !== '' ? $reply : null;
}
