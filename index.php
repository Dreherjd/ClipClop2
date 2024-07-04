<?php
require_once("common/common.php");
require_once("common/dbConnect.php");
require('controllers/index.php');

global $pdo;
$stmt = $pdo->query("
    SELECT
        *
    FROM
        posts
    ORDER BY
        created DESC
");
$result = $stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
<?php include ("includes/header.php"); ?>
<style>
    <?php include 'assets/bootstrap.css'; ?>
</style>
<h3>The Latest Ramblings</h3>
<div class="row">
    <?php foreach ($posts as $post) : ?>
        <div class="col-3" style="margin-top:10px;">
            <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                <div class="card-body">
                        <h4 class="card-title"><?php echo isTrunc($post['title']) ?></h4>
                    <p class="card-text"><?php echo substr($post['content'], 0, 85) . "..." ?></p>
                    <div class="card-footer text-muted">
                        <a href="views/view-post.php?id=<?php echo $post['id']; ?>" style="float:right;" class="card-link text-body-info btn btn-sm btn-info">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include("includes/footer.php"); ?>