<?php 

include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT * FROM `users` WHERE `id` = '$id'";
    $result = mysqli_query($conn,$sql);
    $user = mysqli_fetch_assoc($result);
}else{
    header("location:".ROOT_URL."admin/manage-user.php");
    exit();
}
?>
<body>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit User</h2>
        <form action="<?= ROOT_URL ?>admin/editUserLogic.php" method="post">
            <input type="text" name="first_name" value="<?= $user['firstname']?>" placeholder="First Name">
            <input type="text" name="last_name" value="<?= $user['lastname']?>" placeholder="Last Name">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <select name="user_role" value="">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            
            <button type="submit" name="submit" class="btn">Update</button>
            
        </form>
    </div>
</section>
</body>
</html>