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
if (!function_exists('deletePostById')) {
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
}

/**
 * gets comments for specified post id
 * @param String the id of the post you'd like to get comments for
 * @return Array an array of comments
 */
function getCommentsById($postId)
{
    global $pdo;
    $sql = "
        SELECT
            *
        FROM
            comments
        WHERE
            post_id = :post_id
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            'post_id' => $postId,
        )
    );
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * attmepts to add a comment
 * @param Int the id of the post you'd like to add the comment to
 * @param Array the comment data object/array you'd like to insert
 * @return Array
 */
function addComment($id, array $commentData)
{
    global $pdo;
    $errors = array();
    if (empty($commentData['comment_body'])) {
        $errors['comment_body'] = "You must enter content";
    }
    if (!$errors) {
        $sql = $pdo->prepare("
            INSERT INTO
                comments
                (post_id,comment_body,comment_author,comment_created)
            VALUES
                (:id, :comment_body, :comment_author, :comment_created)
        ");
        if ($sql === false) {
            throw new Exception("Error preparing comment insertion sql");
        }
        $result = $sql->execute(
            array(
                'id' => $id,
                'comment_body' => $commentData['comment_body'],
                'comment_author' => 'Justin', //here's where you'd put the logged in user name
                'comment_created' => getRightNowSqlDate(),
            )
        );
        if ($result === false) {
            $errorInfo = $sql->errorInfo();
            if ($errorInfo) {
                $errors[] = $errorInfo[2];
            }
        }
    }
}

/**
 * deletes comment specified by passed id
 * @param String the id of the comment you'd like to delete
 */
function deleteComment($id)
{
    global $pdo;
    $sql = $pdo->prepare("
        DELETE FROM
            comments
        WHERE
            id = :id
    ");
    $result = $sql->execute(
        array(
            'id' => $id,
        )
    );
    return $result !== false;
}
