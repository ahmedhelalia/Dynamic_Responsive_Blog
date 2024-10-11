<?php
require "inc/blog-header.php";
if(isset($_GET['search']) && isset($_GET['submit'])){
    $search = filter_var($_GET['search'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM `posts` WHERE `title` LIKE '%$search%' ORDER BY date_time DESC;";
    $posts = mysqli_query($conn,$query);

}else{
    header("location: ".ROOT_URL.'blog.php');
    die();
}
?>
<?php if(mysqli_num_rows($posts)>0): ?>



 <section class="posts section__extra-margin">
        <div class="container posts__container">
           <?php while($post = mysqli_fetch_assoc($posts)): ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="images/<?= $post['thumbnail'] ?>">
                </div>
                <div class="post__info">
                <?php 
                // fetch category from categories using category_id 
                $category_id = $post['category_id'];
                $category_query = "SELECT * FROM `categories` WHERE `id` = '$category_id'";
                $category_result = mysqli_query($conn,$category_query);
                $category = mysqli_fetch_assoc($category_result);
                ?>
                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
                    <h3 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= substr($post['title'],0,15)?></a></h3>
                    <p class="post__body">
                    <?=  substr($post['body'],0 , 35); ?>...
                    </p>

                    <?php
                    // fetch author from users table using author_id
                    $author_id = $post['author_id'];
                    $author_query  = "SELECT * FROM `users` WHERE `id` = $author_id;";
                    $author_result = mysqli_query($conn,$author_query);
                    $author = mysqli_fetch_assoc($author_result);
                     ?>
                    <div class="post__author">

                        <div class="post__author-avatar">
                            <img src="images/<?= $author['avatar'] ?>">
                        </div>
                        <div class="post__author-info">
                            <h5>By: <?=  $author['firstname'] ." ". $author['lastname'] ?> </h5>
                            <small><?= date("M d, Y - Hi")?></small>
                        </div>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
    </section>
<?php else: ?>
    <div class="alert__message error lg section__extra-margin">
        <p>NO posts found for this search</p>
    </div>
    <?php endif;?>
<?php include ('inc/footer.php') ?>    