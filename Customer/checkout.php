<?php
    session_start();
?>
<?php 
if (isset($_POST['pkg_id'])){ 
    if(is_numeric($_POST['pkg_id'])){
        $pkg_id = $_POST['pkg_id'];
        $total_adult = $_POST['total_adult'];
        $total_child = $_POST['total_children'];
        $total = $_POST['total'];
        $total_adult_price = $_POST['total_adult_price'];
        $total_child_price = $_POST['total_child_price'];
        //$checkin = date_format($_POST['check-in'],"Y/m/d");
        //$checkout = date_format($_POST['check-out'],"Y/m/d");
        $checkin = $_POST['check-in'];
        $checkout = $_POST['check-out'];
        $userid = $_SESSION['id'];

        include 'Customer.php';
        //create new instance from Customer class
        $customer = new Customer(); 
        $customer ->checkout($userid,$pkg_id, $total_adult, $total_child, $total, $checkin, $checkout);
    }else{
        ?>
        <script>
            location.replace('../index.php');
        </script> 
        <?php
    }
 }else{
    ?>
    <script>
        location.replace('../index.php');
    </script> 
    <?php
}
?>