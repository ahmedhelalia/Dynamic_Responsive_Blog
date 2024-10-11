<?php 
include 'partials/header.php';


// fetch categories from database
$query = "SELECT * FROM `categories`";
$result = mysqli_query($conn,$query);

// get back form data if form was invalid
$title = $_SESSION["add_post_data"]['title'] ?? null;
$body = $_SESSION['add_post_data']['body'] ?? null;

// delete form data session 
unset($_SESSION['add_post_data']);
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <?php if(isset($_SESSION['add_post'])) : ?>
        <div class="alert__message error">
            <p> <?=$_SESSION['add_post'];
               unset($_SESSION['add_post']);
            ?></p>
        </div>
        <?php endif; ?>
        <form action="<?= ROOT_URL ?>admin/addPostLogic.php" enctype="multipart/form-data" method="post">
   
            <input type="text" name="title" value="<?= $title ?>"  placeholder="Title">
            <select name="category" >
                <?php while($category = mysqli_fetch_assoc($result)):?>
                <option value="<?= $category['id']?>"><?= $category['title'] ?></option>
                <?php endwhile; ?>
            </select>

            <?php if(isset($_SESSION['user_is_admin'])): ?>
            <div class="form__control inline">
                <input type="checkbox" name="is_featured" value="1" id="is_featured">
                <label for="is_featured" checked>Featured</label>
            </div>
            <?php endif; ?>

            <textarea name="body" id="" rows="10" placeholder="Body"><?= $body ?></textarea>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
           
            <button type="submit" name="submit" class="btn">Add Post</button>
            
        </form>
    </div>
</section>
<?php 
include '../inc/footer.php';
?>