<?php
/**
 * Работа с пользователями и проектами (статусами клиентов).
 */

require_once __DIR__ . '/db.php';

function getUserWithProject(int $userId): ?array
{
    $pdo = getDb();
    $stmt = $pdo->prepare(
        'SELECT u.id, u.name, u.email, u.role, u.created_at, u.avatar_url,
                p.status, p.progress_percent, p.time_spent_minutes,
                p.stage, p.notes, p.started_at, p.updated_at,
                p.avg_progress_per_day, p.avg_hours_per_day, p.estimated_completion_days
         FROM users u
         LEFT JOIN projects p ON p.user_id = u.id
         WHERE u.id = :id
         LIMIT 1'
    );
    $stmt->execute(['id' => $userId]);
    $data = $stmt->fetch();
    return $data ?: null;
}

function getAllClientsWithProjects(): array
{
    $pdo = getDb();
    $stmt = $pdo->query(
        'SELECT u.id, u.name, u.email, u.role, u.created_at,
                COALESCE(p.status, "") as status,
                COALESCE(p.progress_percent, 0) as progress_percent,
                COALESCE(p.time_spent_minutes, 0) as time_spent_minutes,
                COALESCE(p.stage, "") as stage,
                COALESCE(p.notes, "") as notes,
                COALESCE(p.started_at, "") as started_at,
                COALESCE(p.updated_at, "") as updated_at
         FROM users u
         LEFT JOIN projects p ON p.user_id = u.id
         ORDER BY u.created_at DESC'
    );
    return $stmt->fetchAll();
}

function upsertProject(array $payload): void
{
    $pdo = getDb();
    $now = date('c');

    $fields = [
        'user_id' => (int)$payload['user_id'],
        'status' => trim($payload['status'] ?? ''),
        'progress_percent' => max(0, min(100, (int)$payload['progress_percent'])),
        'time_spent_minutes' => max(0, (int)$payload['time_spent_minutes']),
        'stage' => trim($payload['stage'] ?? ''),
        'notes' => trim($payload['notes'] ?? ''),
        'started_at' => $payload['started_at'] ? trim($payload['started_at']) : null,
        'avg_progress_per_day' => isset($payload['avg_progress_per_day']) && $payload['avg_progress_per_day'] !== '' ? (float)$payload['avg_progress_per_day'] : null,
        'avg_hours_per_day' => isset($payload['avg_hours_per_day']) && $payload['avg_hours_per_day'] !== '' ? (float)$payload['avg_hours_per_day'] : null,
        'estimated_completion_days' => isset($payload['estimated_completion_days']) && $payload['estimated_completion_days'] !== '' ? (int)$payload['estimated_completion_days'] : null,
        'updated_at' => $now,
    ];

    // Проверяем, есть ли уже запись
    $stmt = $pdo->prepare('SELECT id FROM projects WHERE user_id = :user_id LIMIT 1');
    $stmt->execute(['user_id' => $fields['user_id']]);
    $existingId = $stmt->fetchColumn();

    if ($existingId) {
        $stmt = $pdo->prepare(
            'UPDATE projects
             SET status = :status,
                 progress_percent = :progress_percent,
                 time_spent_minutes = :time_spent_minutes,
                 stage = :stage,
                 notes = :notes,
                 started_at = :started_at,
                 avg_progress_per_day = :avg_progress_per_day,
                 avg_hours_per_day = :avg_hours_per_day,
                 estimated_completion_days = :estimated_completion_days,
                 updated_at = :updated_at
             WHERE user_id = :user_id'
        );
        $stmt->execute($fields);
    } else {
        $stmt = $pdo->prepare(
            'INSERT INTO projects (user_id, status, progress_percent, time_spent_minutes, stage, notes, started_at, avg_progress_per_day, avg_hours_per_day, estimated_completion_days, updated_at)
             VALUES (:user_id, :status, :progress_percent, :time_spent_minutes, :stage, :notes, :started_at, :avg_progress_per_day, :avg_hours_per_day, :estimated_completion_days, :updated_at)'
        );
        $stmt->execute($fields);
    }
}

