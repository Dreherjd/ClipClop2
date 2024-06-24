<?php
require_once("../common/common.php");
require_once("../common/dbConnect.php");
require_once '../controllers/edit-comment.php';

if (isset($_GET['id'])) {
    $commentId = $_GET['id'];
    $commentBody = getCommentBodyByCommentId($commentId);
}

$errors[] = array();
if ($_POST) {
    if (isset($_POST['comment-body'])) {
        $commentBody = $_POST['comment-body'];
        if (!$commentBody) {
            $errors[] = "You must enter content to post";
        }
        print_r(array_keys($errors));
    }
    if (!$errors) {
        editComment($comment_id, $commentBody);
        redirect(BASE_URL . 'index.php');
    }
}


?>
<?php include '../includes/header.php'; ?>
<style>
    <?php include '../assets/bootstrap.css' ?>
</style>
<?php if ($errors) : ?>
    <?php foreach($errors as $error) : ?>
        <div class="alert alert-dismissible alert-danger">
        <?php echo $error; ?>
    </div>
    <?php endforeach;?>
<?php endif; ?>
<form method="post">
    <label for="comment-body" class="form-label mt-4">Edit your comment</label>
    <textarea class="form-control" id="comment-body" name="comment-body" rows="3"><?php echo $commentBody['comment_body']; ?></textarea>
    <br />
    <a href="#" class="btn btn-primary btn-sm">Back</a>
    <input class="btn-sm btn btn-primary" type="submit" value="Save" />
</form>
<?php include '../includes/footer.php'; ?>