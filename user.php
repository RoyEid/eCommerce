<?php
include 'init.php';

if (!isset($_GET['userid']) || !is_numeric($_GET['userid'])) {
    echo '<div class="alert alert-danger">Invalid User</div>';
    exit();
}

$userid = intval($_GET['userid']);

$stmt = $con->prepare("SELECT UserID, Username, Date FROM users WHERE UserID = ?");
$stmt->execute([$userid]);
$user = $stmt->fetch();

if (!$user) {
    echo '<div class="alert alert-danger">User not found</div>';
    exit();
}
?>

<div class="container">
    <h1 class="text-center"><?php echo $user['Username']; ?>'s Profile</h1>

    <ul class="list-unstyled">
        <li><strong>Username:</strong> <?php echo $user['Username']; ?></li>
        <li><strong>Member since:</strong> <?php echo $user['Date']; ?></li>
    </ul>

    <hr>

    <h3>User Items</h3>

    <div class="row">
        <?php
        $items = getAllFrom(
            "*",
            "items",
            "WHERE Member_ID = $userid AND Approve = 1",
            "",
            "Item_ID",
            "DESC"
        );

        if (!empty($items)) {
            foreach ($items as $item) {
                echo '<div class="col-sm-6 col-md-3">';
                echo '<div class="thumbnail item-box">';
                echo '<span class="price-tag">$' . $item['Price'] . '</span>';
                echo '<img class="img-responsive" src="img.png">';
                echo '<div class="caption">';
                echo '<h3><a href="items.php?itemid=' . $item['Item_ID'] . '">' . $item['Name'] . '</a></h3>';
                echo '</div></div></div>';
            }
        } else {
            echo '<p>No items to show</p>';
        }
        ?>
    </div>
</div>

<?php include $tpl . 'footer.php'; ?>