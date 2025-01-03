<?php 
include 'partials/header.php';
// fetch current user's post from the data base
$current_user_id = $_SESSION['user_id'];
$query = "SELECT `id` ,`title`,`category_id` FROM `posts` 
           WHERE `author_id`='$current_user_id' ORDER BY `id` DESC;
";
$posts = mysqli_query($conn,$query);
?>


<section class="dashboard">
    <?php if (isset($_SESSION['add_post_success'])):?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add_post_success'];
                   unset($_SESSION['add_post_success'])
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION["edit_post_success"])): ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit_post_success'];
                   unset($_SESSION['edit_post_success']);
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
                    <a href="<?= ROOT_URL ?>admin/add-post.php">
                        <i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php" class="active">
                        <i class="uil uil-postcard"></i>
                        <h5>Manage Posts</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])):?>
                <li>
                    <a href="<?= ROOT_URL ?>admin/add-user.php">
                        <i class="uil uil-user-plus"> </i>
                        <h5>Add User</h5>
                    </a>
                </li>
                <li>
                    <a href="<?=ROOT_URL?>admin/manage-users.php" >
                        <i class="uil uil-users-alt"></i>
                        <h5>Manage User</h5>
                    </a>
                </li>
                <li>
                    <a href="<?= ROOT_URL ?>admin/add-category.php">
                        <i class="uil uil-edit"></i>
                        <h5>Add Category</h5>
                    </a>
                </li>
                <li>
                    <a href="<?=ROOT_URL ?>admin/manage-categories.php">
                        <i class="uil uil-list-ul"> </i>
                        <h5>Manage categories</h5>
                    </a>
                </li>
                <?php endif; ?>
            </ul>

        </aside>
        <main>
            <h2>Manage Users</h2>
            <?php if (mysqli_num_rows($posts)>0): ?>
            <table>
                <thead>
                    <tr>
                        <th>title</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
        
                    </tr>
                </thead>
                <tbody>

                <?php while($post = mysqli_fetch_assoc($posts)): ?>
                    <!-- get category title of each post from categories table -->
                     <?php
                     $category_id = $post['category_id'];
                     $category_query = "SELECT `title` FROM `categories` WHERE `id` = '$category_id';";
                     $category_query_result = mysqli_query($conn,$category_query);
                     $category = mysqli_fetch_assoc($category_query_result);
                      ?>
                    <tr>
                        <td><?= $post['title'] ?></ltd>
                        <td><?= $category['title'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?=$post['id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/deletePost.php?id=<?=$post['id']?>" class="btn danger">Delete</a></td>
                        
                    </tr>

                  
                <?php endwhile; ?>
                    
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert__message error">
                <p>No Posts Found</p>
            </div>
        <?php endif; ?>
        </main>
    </div>
</section>

<?php 
include '../inc/footer.php';
?>