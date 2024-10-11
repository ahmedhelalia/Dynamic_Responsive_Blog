<?php 
include 'partials/header.php';
// fetch categories from data base
$category_query = "SELECT * FROM `categories`";
$categories = mysqli_query($conn,$category_query);

// fetch post data from data base
if (isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM `posts` WHERE `id` = '$id';";
    $result = mysqli_query($conn,$query);
    $post = mysqli_fetch_assoc($result);

}else{
    header("location:".ROOT_URL.'admin/');
}
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Post</h2>
        
        <form action="<?= ROOT_URL ?>admin/editPostLogic.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <input type="hidden" name="previous_thumbnail" value="<?= $post['thumbnail'] ?>">
            <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title">
            <select name="category">
                <?php while($category= mysqli_fetch_assoc($categories)): ?>
                <option value="<?= $category['id'] ?>"><?= $category['title']?></option>
                <?php endwhile; ?>
            </select>
            <?php if(isset($_SESSION['user_is_admin'])):?>
            <div class="form__control inline">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" checked>
                <label for="is_featured">Featured</label>
            </div>
            <?php endif; ?>
            <textarea name="body" id="" rows="10" placeholder="Body"><?=$post ['body'] ?></textarea>
            <div class="form__control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" >
            </div>
           
            <button type="submit" name="submit" class="btn">Update Post</button>
            
        </form>
    </div>
</section>
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
  <script src="main.js"></script>
</body>
</html>