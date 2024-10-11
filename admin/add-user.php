<?php 
include 'partials/header.php';
  // get back form data if there was an error
$first_name = $_SESSION['add_user_data']['first_name'] ?? null;
$last_name = $_SESSION['add_user_data']['last_name']?? null;
$username = $_SESSION['add_user_data']['username']?? null;
$email = $_SESSION['add_user_data']['email']?? null;
$password = $_SESSION['add_user_data']['password'] ?? null;
$confirmPassword = $_SESSION['add_user_data']['confirm_password']?? null;
// delete session data 
unset($_SESSION['add_user_data']);
?>
<body>
<section class="form__section">

    <div class="container form__section-container">
        <h2>Add User</h2>
        <?php if(isset($_SESSION['add_user'])): ?>
        <div class="alert__message error">
            <p> <?= $_SESSION['add_user'];
                    unset($_SESSION['add_user']);
            ?></p>
        </div>
        <?php endif; ?>
        <form action="<?= ROOT_URL ?>admin/adduser_logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="first_name" value="<?= $first_name ?>" placeholder="First Name">
            <input type="text" name="last_name" value="<?= $last_name ?>" placeholder="Last Name">
            <input type="text" name="user_name" value="<?= $username ?>" placeholder="User Name">
            <input type="text" name="email" value="<?= $email ?>" placeholder="Email">
            <input type="text" name="password" value="<?= $password ?>" placeholder="Password">
            <input type="text" name="confirm_password" value="<?= $confirmPassword ?>" placeholder="Confirm Password">
            <select name="user_role">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Add</button>
            
        </form>
    </div>
</section>
</body>
</html>