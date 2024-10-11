<?php
include ("inc/blog-header.php");


// fetch posts if id is set
if (isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM `posts` WHERE `category_id` = '$id' ORDER BY date_time DESC";
    $posts = mysqli_query($conn,$query);
}else{
    header("location: ".ROOT_URL.'blog.php');
    die();
}
?>

    <!--  ======================== END OF NAV ==============================================-->
   
<header class="category__title">
    <h2>
        <?php
        // fetch category from categories table using category_id of post
        $category_id = $id;
        $category_query = "SELECT * FROM `categories` WHERE `id` = '$id'";
        $category_result = mysqli_query($conn,$category_query);
        $category = mysqli_fetch_assoc($category_result);
        echo $category['title'];
         ?>
    </h2>
</header>
<?php if (mysqli_num_rows($posts)>0):?>
    <section class="posts">
        <div class="container posts__container">
           <?php while($post = mysqli_fetch_assoc($posts)): ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="images/<?= $post['thumbnail'] ?>">
                </div>
                <div class="post__info">
                
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
    <?php else:  ?>
        <div class="alert__message error lg">
            <p>No Posts Found For this Category</p>
        </div>
        <?php endif;?>
    <!-- ============================= END OF SECTION POSTS ========================== -->
    <div class="category__buttons">
        <div class="container category__buttons-container">
            <?php
            $all_categories_query = "SELECT * FROM `categories`";
            $all_categories = mysqli_query($conn,$all_categories_query);
             ?>
             <?php while($category=mysqli_fetch_assoc($all_categories)):?>
              <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
             <?php endwhile;?>
          
        </div>
     </div>
     <!-- ==================================END OF CATEGORY BUTTONS ===========================-->
     <?php
include ("inc/footer.php");
 ?>