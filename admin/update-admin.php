<?php include('./partials/menu.php'); ?>
<h1>Update Admin</h1>

<?php
if (isset($_SESSION['update'])) {
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_admin WHERE id=$id";
$res = mysqli_query($conn, $sql);
if ($res) {
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $rows = mysqli_fetch_assoc($res);
        $full_name = $rows['full_name'];
        $username = $rows['username'];
    } else   header('location:' . SITEURL . '/admin/manage-admin.php');
}

?>



<form action="" method="POST">
    <table class="tbl-30">
        <tr>
            <td>Full name: </td>
            <td>
                <input type="text" name="full_name" value="<?php echo $full_name; ?>">
            </td>
        </tr>
        <tr>
            <td>User name: </td>
            <td>
                <input type="text" name="username" value="<?php echo $username; ?>">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
            </td>
        </tr>
    </table>
</form>



<?php include('./partials/footer.php'); ?>

<?php
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "UPDATE  tbl_admin SET 
         full_name='$full_name',
         username='$username'
        WHERE id='$id'
        ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['update'] = '<div class="success">Update Successfully</div>';
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        $_SESSION['update'] = '<div class="failure">Failed to Update Admin</div>';
        header("location:" . SITEURL . 'admin/update-admin.php');
    }
}
?>