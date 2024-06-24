<?php

function getCommentBodyByCommentId($commentId)
{
    global $pdo;
    $sql = $pdo->prepare("
        SELECT
            comment_body
        FROM
            comments
        WHERE
            id = :id
    ");
    $result = $sql->execute(
        array(
            'id' => $commentId,
        )
    );
    if ($result) {
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        return $row;
    } else {
        return null;
    }
}

function editComment($commentId, $commentBody)
{
    global $pdo;
    $sql = $pdo->prepare("
        UPDATE
            comments
        SET
            comment_body = :comment_body
        WHERE
            id = :id
    ");
    $result = $sql->execute(
        array(
            'comment_body' => $commentBody,
            'id' => $commentId,
        )
    );
    if($result === false){
        throw new Exception("Could not execute edit comment query");
    }
    return true;
}
