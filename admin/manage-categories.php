<?php 
include 'partials/header.php';
// fetch categories from the data base
$sql = "SELECT * FROM `categories` ORDER BY `title`;";
$categories = mysqli_query($conn,$sql);
?>



<section class="dashboard">
    <?php if(isset($_SESSION['add_category_success'])): ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add_category_success'];
                    unset($_SESSION['add_category_success']);
                ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit_category_success'])):?> 
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit_category_success'];
                    unset($_SESSION['edit_category_success']);
                ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete_category_success'])): ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete_category_success'];
                    unset($_SESSION['delete_category_success']);
                ?>
            </p>
        </div>
       <?php endif; ?> 
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php">
                        <i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <i class="uil uil-postcard"></i>
                        <h5>Manage Posts</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])):?>
                <li>
                    <a href="add-user.php">
                        <i class="uil uil-user-plus"> </i>
                        <h5>Add User</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-users.php">
                        <i class="uil uil-users-alt"></i>
                        <h5>Manage User</h5>
                    </a>
                </li>
                <li>
                    <a href="add-category.php">
                        <i class="uil uil-edit"></i>
                        <h5>Add Category</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-categories.php" class="active">
                        <i class="uil uil-list-ul"> </i>
                        <h5>Manage categories</h5>
                    </a>
                </li>
           <?php endif; ?>
            </ul>

        </aside>
        <main>
            <h2>Manage Categories</h2>
            <?php if(mysqli_num_rows($categories)>0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($category = mysqli_fetch_assoc($categories)): ?>
                    <tr>
                        <td><?= $category['title'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/deleteCategory.php?id=<?= $category['id']?>" class="btn danger">Delete</a></td>
                    </tr>
                   <?php endwhile;?>
                </tbody>
            </table>
            <?php else: ?>
                <div class="alert__message error">
                    <p>No Categories Found </p>
                </div>
               <?php endif; ?> 
        </main>
    </div>
</section>

<?php 
include '../inc/footer.php';
?>