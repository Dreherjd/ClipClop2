<?php
ob_start();
require_once("../common/common.php");
require_once("../common/dbConnect.php");
require_once '../controllers/view-post.php';

$commentData = null;
if ($_POST) {
    if (isset($_POST['add-comment'])) {
        $commentData = array(
            'comment_id' => $_POST['id'],
            'comment_author' => 'Justin',
            'comment_body' => $_POST['comment_body'],
            'comment_created' => getRightNowSqlDate(),
        );
        $errors = addComment($id, $commentData);
    } else if (isset($_POST['delete-comment'])) {
        $keys = array_keys($_POST['delete-comment']);
        $deleteCommentId = $keys[0];
        if($deleteCommentId){
            deleteComment($deleteCommentId);
            redirect(BASE_URL . 'views/view-post.php?id=' . $id);
        }
    } else if (isset($_POST['edit-comment'])) {
        $keys = array_keys($_POST['edit-comment']);
        $editCommentId = $keys[0];
        if($editCommentId){
            editComment($id, $newBody);
            redirect(BASE_URL . 'views/view-post.php?id' . $id);
        }
    }
    if (!$errors) {
        redirect(BASE_URL . 'views/view-post.php?id=' . $id);
    }
} else {
    if (isset($_GET['id'])) {
        $commentData = getCommentsById($_GET['id']);
    } else {
        $commentData = array(
            'comment_id' => '',
            'comment_author' => '',
            'comment_body' => '',
            'comment_created' => '',
        );
    }
}
ob_end_flush();
?>
<?php foreach ($commentData as $comment) : ?>
    <div class="card border-secondary mb-3">
        <div class="card-body">
            <form method="post">
                <h4 class="card-title"><?php echo $comment['comment_author'] ?> said: </h4>
                <p class="card-text"><?php echo $comment['comment_body'] ?></p>
                <a class="btn btn-primary btn-sm" href="<?php echo BASE_URL?>views/edit-comment.php?id=<?php echo $comment['id']?>">Edit</a>
                <input type="submit" name="delete-comment[<?php echo $comment['id']?>]" value="Delete" class="btn btn-warning btn-sm" />
            </form>
        </div>
    </div>
<?php endforeach; ?>
<form method="post">
    <div>
        <label for="comment_body" class="form-label mt-4">Your Comment:</label>
        <textarea class="form-control" id="comment_body" name="comment_body" rows="5"></textarea>
    </div>
    <br />
    <button type="submit" name="add-comment" class="btn btn-primary">Submit</button>
</form>