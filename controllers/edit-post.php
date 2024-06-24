<?php

function addPost($title, $content, $author)
{
    global $pdo;
    $sql = $pdo->prepare("
        INSERT INTO
            posts
            (title, content, created, author)
        VALUES
            (:title, :content, :created, :author)
    ");
    $result = $sql->execute(
        array(
            'title' => $title,
            'content' => $content,
            'created' => getRightNowSqlDate(),
            'author' => $author,
        )
    );
    if ($result === false) {
        throw new Exception("Error in inserting post");
    }
    return $pdo->lastInsertId();
}

function editPost($title, $content, $postId)
{
    global $pdo;
    $sql = $pdo->prepare("
        UPDATE
            posts
        SET
            title = :title,
            content = :content
        WHERE
            id = :id
    ");
    $result = $sql->execute(
        array(
            'title' => $title,
            'content' => $content,
            'id' => $postId,
        )
    );
    if ($result === false) {
        throw new Exception("Could not execute edit query");
    }
    return $postId;
}

if (!function_exists('getPostById')) {
    function getPostById($postId)
    {
        global $pdo;
        if ($postId) {
            $sql = $pdo->prepare("
                SELECT
                    id,title,content,created,author
                FROM
                    posts
                WHERE
                    id = :id
            ");
            $result = $sql->execute(
                array(
                    'id' => $postId
                )
            );
            if ($result) {
                //use fetch instead of fetchAll because fetchAll returns
                //an array of arrays, where fetch returns just the one array
                $row = $sql->fetch(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return null;
            }
        }
    }
}