<?php
require_once("../common/common.php");
require_once("../common/dbConnect.php");
require '../controllers/view-post.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $record = getPostById($id);
}
if (!$record) {
    header(BASE_URL . "index.php");
}

if($_POST){
    if(isset($_POST['delete-post'])){
        $keys = array_keys($_POST['delete-post']);
        $deletePostId = $keys[0];
        if($deletePostId){
            deletePostById($deletePostId);
            header('Location: ' . BASE_URL . 'index.php');
        }
    }
}

$content_text = escapeHTML($record['content']);
$para_text = str_replace("\n", "<p></p>", $content_text);


?>




<?php include '../includes/header.php'; ?>
<style>
    <?php include '../assets/bootstrap.css'; ?>
</style>
<div class="jumbotron">
    <h1 class="display-3"><?php echo escapeHTML($record['title']) ?></h1>
    <p class="lead"><?php echo $para_text ?></p>
    <hr class="my-4">
    <p><i>Written By: </i><?php echo $record['author']; ?> <i>on</i> <?php echo $record['created'] ?></p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="<?php echo BASE_URL ?>index.php" role="button">Back</a>
        <a class="btn btn-primary btn-lg" href="<?php echo BASE_URL ?>views/edit-post.php?id=<?php echo $record['id'] ?>" role="button">Edit</a>
    <form method="post">
        <input type="submit" class="btn btn-warning btn-lg" name="delete-post[<?php echo $record['id']; ?>]" value="Delete" />
    </form>
    </p>
</div>



<?php include '../includes/footer.php'; ?>