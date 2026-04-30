<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit; }

$file = __DIR__ . '/data.json';

/* ── GET：返回全部记录 ─────────────────────── */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!file_exists($file)) {
        echo json_encode(['records' => []], JSON_UNESCAPED_UNICODE);
    } else {
        echo file_get_contents($file);
    }
    exit;
}

/* ── POST：追加新记录 / 回复记录 ──────────── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    // ── 回复已有记录 ──────────────────────────
    if (isset($input['action']) && $input['action'] === 'reply') {
        if (empty($input['id']) || empty($input['reply'])) {
            http_response_code(400);
            echo json_encode(['error' => 'invalid']);
            exit;
        }

        $fp = fopen($file, 'c+');
        flock($fp, LOCK_EX);

        $content = stream_get_contents($fp);
        $data = $content ? json_decode($content, true) : ['records' => []];

        $found = false;
        foreach ($data['records'] as &$rec) {
            if ($rec['id'] === (string)$input['id']) {
                if (!empty($rec['reply'])) {
                    flock($fp, LOCK_UN);
                    fclose($fp);
                    http_response_code(409);
                    echo json_encode(['error' => 'already_replied']);
                    exit;
                }
                $rec['reply'] = [
                    'text' => mb_substr((string)$input['reply'], 0, 100),
                    'time' => date('c'),
                ];
                $found = true;
                break;
            }
        }
        unset($rec);

        if (!$found) {
            flock($fp, LOCK_UN);
            fclose($fp);
            http_response_code(404);
            echo json_encode(['error' => 'not_found']);
            exit;
        }

        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        flock($fp, LOCK_UN);
        fclose($fp);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // ── 追加一条新记录 ────────────────────────
    if (empty($input['id']) || empty($input['date']) || !isset($input['score'])) {
        http_response_code(400);
        echo json_encode(['error' => 'invalid']);
        exit;
    }

    // 加文件锁，防止并发写入冲突
    $fp = fopen($file, 'c+');
    flock($fp, LOCK_EX);

    $content = stream_get_contents($fp);
    $data = $content ? json_decode($content, true) : ['records' => []];

    $data['records'][] = [
        'id'    => (string)$input['id'],
        'date'  => (string)$input['date'],
        'desc'  => (string)$input['desc'],
        'score' => (int)$input['score'],
    ];

    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    flock($fp, LOCK_UN);
    fclose($fp);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'method not allowed']);
