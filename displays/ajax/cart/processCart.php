<?php
include '../../../db/config.php';
include './func_libs.php';
require_once '../../config_vnpay.php';


$GLOBALS['connection'] = $connect;

switch ($_GET['action']) {
    case 'add':
        $result = update_cart(true);
        $totalQuantity = getTotalQuantity();
        $result['total_quantity'] = $totalQuantity;
        echo json_encode($result);
        break;
    case 'update':
        $result = update_cart();
        $totalQuantity = getTotalQuantity();
        $result['total_quantity'] = $totalQuantity;
        echo json_encode($result);
        break;
    case 'delete':
        if (isset($_POST['id'])) {
            unset($_SESSION['cart'][$_POST['id']]);
        }
        echo json_encode(array(
            'status' => 1,
            'message' => 'Xóa sản phẩm thành công'
            // 'total_quantity' => getTotalQuantity()

        ));
        break;
    case "submit":
        if(empty($_SESSION['cart'])){
        echo json_encode(array(
                    'status' => 0,
                    'message' => "Giỏ hàng rỗng. Bạn vui lòng lựa chọn sản phẩm vào giỏ hàng."
                ));exit;
}
$products = mysqli_query($connect, "SELECT * FROM nongsansach.sanpham WHERE MaSP IN (" . implode(",", array_keys($_SESSION['cart'])) . ")");
$total = 0;
$orderProducts = array();
$updateString = "";
$changeQuantity = false;
$code_order = rand(0,9999);
$trangthai=1;
$card_payment = $_POST["payment"];
    while ($row = mysqli_fetch_array($products)) {
        $orderProducts[] = $row;
        if ($_SESSION['cart'][$row['MaSP']] > $row['SoLuong']) { //Thay đổi số lượng sản phẩm trong giỏ hàng
            $_SESSION['cart'][$row['MaSP']] = $row['SoLuong'];
            $changeQuantity = true;
        } else {
            $total += $row['GiaSP'] * $_SESSION['cart'][$row['MaSP']];
            $updateString .= " when MaSP = " . $row['MaSP'] . " then SoLuong - " . $_SESSION['cart'][$row['MaSP']]; //Trừ đi sản phẩm tồn kho
            
        }
    }
        if ($changeQuantity == false) {
        $updateQuantity = mysqli_query($connect, "UPDATE nongsansach.sanpham set SoLuong = CASE" . $updateString . " END where MaSP in (" . implode(",", array_keys($_SESSION['cart'])) . ")");
        $insertOrder = "INSERT INTO nongsansach.donhang(TenKH,SDT,DiaChi,TrangThai,Payment,code_cart)
        VALUES ('".$_POST['TenKH']."', '".$_POST['SDT']."','".$_POST['DiaChi']."','".$trangthai."','".$card_payment."','".$code_order."')";
        $cart_query=mysqli_query($connect,$insertOrder);
        $last_id = mysqli_insert_id($connect); 
        $dateTime = date("Y-m-d H:i:s");
        $ngaytao = $dateTime;
        $orderID = $connect->insert_id;
        $insertString = "";
        foreach ($orderProducts as $key => $product) {
            $insertString .= "(NULL,'" . $orderID . "', '" . $product['MaSP'] . "', '" . $_SESSION['cart'][$product['MaSP']] . "', '" . $product['GiaSP'] . "','" . $total . "', '" . $ngaytao . "','".$code_order."')";
            if ($key != count($orderProducts) - 1) {
                $insertString .= ",";
            }
        }
        $insertOrder ="INSERT INTO nongsansach.chitietdonhang(MaCTDH,MaDH,MaSP,SoLuong,GiaSP,ThanhTien,NgayTao,code_cart) VALUES " . $insertString . ";";
        $cart_detail=mysqli_query($connect,$insertOrder);
    unset($_SESSION['cart']);
     echo json_encode(array(
        'status' => 1,
        'message' => "Đặt hàng thành công."
    ));
    }else{ echo json_encode(array(
        'status' => 0,
        'message' => "Đặt hàng không thành công do số lượng sản phẩm tồn kho không đủ. Bạn vui lòng kiểm tra lại giỏ hàng"
    ));
}

break;
default:
break;
        }
       

function update_cart($add = false)
{
    $changeQuantity = false;
    foreach ($_POST['quantity'] as $id => $quantity) {
        if ($quantity == 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            if (!isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] = 0;
            }
            if ($add) {
                $_SESSION['cart'][$id] += $quantity;
            } else {
                $_SESSION['cart'][$id] = $quantity;
            }
            //Kiểm tra  tồn kho
            $addProduct = mysqli_query($GLOBALS['connection'], "SELECT `SoLuong` FROM nongsansach.sanpham WHERE `MaSP` = " . $id);
            $addProduct = mysqli_fetch_assoc($addProduct);
            if ($_SESSION['cart'][$id] > $addProduct['SoLuong']) {
                $_SESSION['cart'][$id] = $addProduct['SoLuong'];
                if ($add) {
                    return array(
                        'status' => 0,
                        'message' => "Số lượng sản phẩm tồn kho chỉ còn: " . $addProduct['SoLuong'] . " sản phẩm."
                    );
                } else {
                    $changeQuantity = true;
                }
            }
            if ($add) {
                return array(
                    'status' => 1,
                    'message' => "Thêm sản phẩm thành công."
                );
            }
        }
    }
    if ($changeQuantity) {
        return array(
            'status' => 0,
            'message' => "Số lượng sản phẩm giỏ hàng đã thay đổi do sô lượng tồn kho không đủ. Ban vui lòng kiểm tra lại giỏ hàng.",
        );
    } else {
        return array(
            'status' => 1,
            'message' => "Cập nhật thành công.",
        );
    
    }
}
