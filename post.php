<?php
include ('inc/blog-header.php');

// fetch post from data base if id is set
if (isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT * FROM `posts` WHERE `id` = '$id';";
    $result =  mysqli_query($conn,$sql);
    $post = mysqli_fetch_assoc($result);
}else{
    header("location: ".ROOT_URL."blog.php");
}
 ?>
    <!--  ======================== END OF NAV ==============================================-->
      <section class="singlepost">
        <div class="container singlepost__container">
            <h2><?= $post['title'] ?></h2>
            <div class="post__author">
                    <?php
                    // fetch author from users table using author_id
                    $author_id = $post['author_id'];
                    $author_query  = "SELECT * FROM `users` WHERE `id` = $author_id;";
                    $author_result = mysqli_query($conn,$author_query);
                    $author = mysqli_fetch_assoc($author_result);
                     ?>
                    <div class="post__author-avatar">
                        <img src="images/<?= $author['avatar'] ?>">
                    </div>
                    <div class="post__author-info">
                        <h5>By :<?=  $author['firstname'] ." ". $author['lastname'] ?></h5>
                        <small><?= date("M d, Y - Hi")?></small>
                    </div>
                    <div class="singlepost__thumbnail">
                        <img src="./images/<?= $post['thumbnail'] ?>" >
                    </div>
                    <p>
                        <?= $post['body'] ?>
                    </p>
                </div>
            
        </div>
      </section>
      <!-- ===================================== END OF SINGLE POST =============================-->
      <footer>
        <div class="footer__socials">
            <a href="https://youtube.com/" target="_blank"><i class="uil uil-youtube"></i></a>
            <a href="https://facebook.com/" target="_blank"><i class="uil uil-facebook-f"></i></a>
            <a href="https://instagram.com/" target="_blank"><i class="uil uil-instagram-alt"></i></a>
            <a href="https://twitter.com/" target="_blank"><i class="uil uil-twitter"></i></a>
            <a href="https://linkedin.com/" target="_blank"><i class="uil uil-linkedin"></i></a>
        </div>
        <div class="container footer__container">
            <article>
                <h4>Categories</h4>
                <ul>
                    <li><a href="">Art</a></li>
                    <li><a href="">Wild Life</a></li>
                    <li><a href="">Travel</a></li>
                    <li><a href="">Science & Technoloy</a></li>
                    <li><a href="">Music</a></li>
                    <li><a href="">Food</a></li>
                </ul>
            </article>
            <article>
                <h4>Support</h4>
                <ul>
                    <li><a href="">Online Support</a></li>
                    <li><a href="">Call Numbers</a></li>
                    <li><a href="">Emails</a></li>
                    <li><a href="">Location</a></li>
                </ul>
            </article>
            <article>
                <h4>Blog</h4>
                <ul>
                    <li><a href="">Trending</a></li>
                    <li><a href="">Recent</a></li>
                    <li><a href="">Popular</a></li>
                </ul>
            </article>
            <article>
                <h4>Pemalinks</h4>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Contact Us</a></li>
                </ul>
            </article>
        </div>
        <div class="footer__copyright">
            <small>Copyright &copy; Heloo All Rights Reserved</small>
        </div>
      </footer>
<script src="js/main.js"></script>
</body>
</html>