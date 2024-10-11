<?php
include 'partials/header.php';

// Fetch Users From data base but not  current user
$current_admin_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `users` WHERE NOT `id` = '$current_admin_id';";
$users  = mysqli_query($conn,$sql);


?>

<section class="dashboard">
    <?php if (isset($_SESSION['add_user_success'])): ?>
        <div class="alert__message success">
            <p>
                <?= $_SESSION['add_user_success'];
                unset($_SESSION['add_user_success']);
                ?>
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit_user_success'])): // Shows if editing user was successfully ?>
        <div class="alert__message success">
            <p>
                <?= $_SESSION['edit_user_success'];
                unset($_SESSION['edit_user_success']);
                ?>
            </p>
        </div>
  
    <?php elseif(isset($_SESSION['delete_user_success'])): // show if user deleted successfully ?> 
        <div class="alert__message success">
            <p>
                <?= $_SESSION['delete_user_success'];
                unset($_SESSION['delete_user_success']);
                ?>
            </p>
        </div>
     <?php endif;?> 

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
                <?php if (isset($_SESSION['user_is_admin'])): ?>
                    <li>
                        <a href="add-user.php">
                            <i class="uil uil-user-plus"> </i>
                            <h5>Add User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-users.php" class="active">
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
                        <a href="manage-categories.php">
                            <i class="uil uil-list-ul"> </i>
                            <h5>Manage categories</h5>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>

        </aside>
        <main>
            <h2>Manage Users</h2>
            <?php
            // check if the number of rows is greater than 0 
            if(mysqli_num_rows($users)>0): 
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($users)): ?>
                    <tr>
                        <td><?= $user['firstname'] . $user['lastname'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><a href="<?=ROOT_URL?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Edit</a></td>
                        <td><a href="<?=ROOT_URL?>admin/deleteUser.php?id=<?= $user['id'] ?>" class="btn danger">Delete</a></td>
                        <td><?= $user['admin']? "Yes":'NO' ?></td>
                    </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>
            <?php else: ?>
                <div class="alert__message error">
                    <p>NO Users Found</p>
                </div>
            <?php   endif; ?>
        </main>
    </div>
</section>

<?php
include '../inc/footer.php';
?>