<?php
session_start();
include ('../database/linklinkz.php');
$email=$_SESSION['supplier'];
/*if(!isset($_SESSION['email']) && empty($_SESSION['email']) ){
 header('location:login.php');
}*/


//if(isset($_GET['id']) & !empty($_GET['id'])){
   // $id = $_GET['id'];


   if(isset($_GET['id']) & !empty($_GET['id'])){
    $id = $_GET['id'];


    $sql = "SELECT thumb FROM supplier WHERE SupplierID=$id";
    $res = mysqli_query($conn, $sql);
    $r = mysqli_fetch_assoc($res);
 

    if(!empty($r['thumb'])){
        if(unlink($r['thumb'])){
            $delsql = "UPDATE supplier SET thumb='' WHERE SupplierID=$id";
            if(mysqli_query($conn, $delsql)){
                header("location:editSupplier.php?id={$id}");
            }
        }else{
            $delsql = "UPDATE supplier SET thumb='' WHERE SupplierID=$id";
            if(mysqli_query($conn, $delsql)){
                header("location:editSupplier.php?id={$id}");
            }
        }

}
}



// if(isset($_GET['id'])){
//    $product_id = $_GET['id'];

   


   

// //   $sql = "DELETE FROM products WHERE product_id='$product_id'";
// //   $result = mysqli_query($conn, $sql);
// //   header('location:products.php');


// }


