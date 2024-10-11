<?php 
include 'partials/header.php';


// get back form data if invalid input
$title = $_SESSION['add_category_data']['title'] ?? null;
$description = $_SESSION['add_category_data']['description'] ?? null;
unset($_SESSION['add_category_data']);
?>
    <!--  ======================== END OF NAV ==============================================-->

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <?php if(isset($_SESSION['add_category'])): ?>
        <div class="alert__message error">
            <p> <?=  $_SESSION['add_category'];
                    unset($_SESSION['add_category']);
             ?></p>
            
        </div>
        <?php endif; ?> 
        <form action="<?= ROOT_URL ?>admin/addCategoryLogic.php" method="post">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
            <textarea name="description" value="<?= $description ?>" rows="4" placeholder="Description"></textarea>
           
            <button type="submit" name="submit" class="btn">Add Category</button>
            
        </form>
    </div>
</section>
<?php 
include '../inc/footer.php';
?>