<?php

/**
 * gets a single post specified by the ID passed
 * @param String the id of the post you'd like to retreive
 * @return Array the post object
 */
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

/**
 * Deletes a single post specified by the id passed
 * @param String the id of the post you'd like to delete
 * @return boolean returns true upon successful deletion
 */
function deletePostById($postId)
{
    global $pdo;
    $sql = $pdo->prepare("
        DELETE FROM
            posts
        WHERE
            id = :id
    ");
    $result = $sql->execute(
        array(
            'id' => $postId
        )
    );
    return $result !== false;
}
