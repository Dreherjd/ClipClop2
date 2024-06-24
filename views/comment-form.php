<?php
require_once("../common/common.php");
require_once("../common/dbConnect.php");
require_once '../controllers/view-post.php';

$commentData = null;
if ($_POST) {
    if (isset($_POST['add-comment'])) {
        $commentData = array(
            'comment_author' => 'Justin',
            'comment_body' => $_POST['comment_body'],
            'comment_created' => getRightNowSqlDate(),
        );
        $errors = addComment($id, $commentData);
    } else if (isset($_POST['delete-comment'])) {
    } else if (isset($_POST['edit-comment'])) {
    }
    if (!$errors) {
        redirect('views/view-post.php?id=' . $id);
    }
} else {
    if (isset($_GET['id'])) {
        $commentData = getCommentsById($_GET['id']);
    } else {
        $commentData = array(
            'comment_author' => '',
            'comment_body' => '',
            'comment_created' => '',
        );
    }
}
?>
<?php foreach ($commentData as $comment) : ?>
    <div class="card border-secondary mb-3">
        <div class="card-body">
            <form method="post">
                <h4 class="card-title"><?php echo $comment['comment_author'] ?> said: </h4>
                <p class="card-text"><?php echo $comment['comment_body'] ?></p>
                <input type="submit" name="edit-comment" value="Edit" class="btn btn-primary btn-sm" />
                <input type="submit" name="delete-comment" value="Delete" class="btn btn-warning btn-sm" />
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