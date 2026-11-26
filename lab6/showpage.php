<?php
function PokazPodstrone(PDO $pdo, string $alias): ?array
{
    $sql = 'SELECT id, page_title, page_content
            FROM page_list
            WHERE alias = :alias AND status = 1
            LIMIT 1';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':alias' => $alias]);
    $rekord = $stmt->fetch();

    return $rekord !== false ? $rekord : null;
}