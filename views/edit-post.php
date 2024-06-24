<?php
require_once("../common/common.php");
require_once("../common/dbConnect.php");
include '../controllers/edit-post.php';

//set default values for title and body
$title = $content = '';
$postId = null;
if (isset($_GET['id'])) {
    $post = getPostById($_GET['id']);
    if ($post) {
        $postId = $_GET['id'];
        $title = $post['title'];
        $content = $post['content'];
    }
}

$errors = array();
if (!empty($_POST)) {
    $title = $_POST['title'];
    if (!$title) {
        $errors[] = "You need a title";
    }
    $content = $_POST['content'];
    if (!$content) {
        $errors[] = "You need content to post";
    }
    if (!$errors) {
        if ($postId) {
            editPost($title, $content, $postId);
        } else {
            //add
            $author = "Justin"; //TODO: here's where you'd input the currently logged in users name.
            $postId = addPost($title, $content, $author);
            if ($postId === false) {
                $errors[] = "Error adding new post";
            }
        }
    }
    if (!$errors) {
        redirect('views/view-post.php?id=' . $postId);
    }
}
?>
<?php include '../includes/header.php'; ?>
<style>
    <?php include '../assets/bootstrap.css'; ?>
</style>
<h3>New Post</h3>
<form method="post">
    <div>
        <label for="title" class="form-label mt-4">Title</label>
        <input value="<?php echo $title ?>" type="text" class="form-control" id="title" name="title">
    </div>
    <div>
        <label for="content" class="form-label mt-4">Example textarea</label>
        <textarea value="<?php echo escapeHTML($content) ?>" class="form-control" id="content" name="content" rows="5" cols="70"><?php echo escapeHTML($content) ?></textarea>
    </div>
    <br />
    <button type="submit" class="btn btn-primary">Submit</button>
    <?php if ($postId) : ?>
        <a href="<?php echo BASE_URL ?>views/view-post.php?id=<?php echo $postId ?>" class="btn btn-warning">Cancel</a>
    <?php else : ?>
        <a href="<?php echo BASE_URL ?>index.php" class="btn btn-warning">Cancel</a>
    <?php endif; ?>
</form>

<?php if ($errors) : ?>
    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


<?php include '../includes/footer.php'; ?>