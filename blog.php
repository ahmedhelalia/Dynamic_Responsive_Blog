<?php 
include ("inc/blog-header.php");
// fetch ALL Posts
$query = "SELECT * FROM `posts` ORDER BY date_time DESC";
$posts = mysqli_query($conn,$query);
?>
    <!--  ======================== END OF NAV ==============================================-->
   <section class="search__bar">
    <form action="<?= ROOT_URL?>search.php" method="get" class="container search__bar-container">
        <div>
            <i class="uil uil-search"></i>
            <input type="search" name="search" id="" placeholder="Search">
        </div>
        <button type="submit" name="submit" class="btn">Go</button>
    </form>
    <section class="posts">
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
<?php include("inc/footer.php"); ?>