<?php
    include '../db/config.php';
    $product = mysqli_query($connect, "SELECT * FROM nongsansach.sanpham");
$category = mysqli_query($connect, "SELECT * FROM nongsansach.danhmuc");
$unit = mysqli_query($connect, "SELECT * FROM nongsansach.donvitinh");

if(isset($_GET['masp'])){
    $id= $_GET['masp'];

    $data_query_sp = mysqli_query($connect, "SELECT * FROM nongsansach.sanpham WHERE MaSP = '$_GET[masp]' LIMIT 1");
    $product_sp =mysqli_fetch_assoc($data_query_sp);
}
    if(isset($_POST['tensp'])){
        $tensp = $_POST['tensp'];
        $soluong = $_POST['soluong'];
        $giasp = $_POST['giasp'];
        $mota = $_POST['mota'];
        $madm = $_POST['madm'];
        $madv = $_POST['madv'];

        if(isset($_FILES['imagesp'])){
            $file = $_FILES['imagesp'];
            $file_name = $file['name'];
            if($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png'){
            move_uploaded_file($file['tmp_name'],'../uploads/'.$file_name);
        }else{
            echo 'Không đúng định dạng';
            $file_name='';
        }
    }
        if(isset($_FILES['imagesps'])){
            $files = $_FILES['imagesps'];
            $file_names = $files['name'];
            
            foreach($file_names as $key => $value){
                move_uploaded_file($files['tmp_name'][$key],'../uploads/'.$value);
            }
            }
        
            $sql_them ="INSERT INTO nongsansach.sanpham(TenSP,AnhSP,SoLuong,GiaSP,MoTa,MaDM,MaDV) VALUE ('".$tensp."','".$file_name."'
            ,'".$soluong."','".$giasp."','".$mota."','".$madm."','".$madv."')";
       $product_query = mysqli_query($connect,$sql_them);
       $id_pro = mysqli_insert_id($connect);
        foreach($file_names as $key => $value){
            mysqli_query($connect, "INSERT INTO nongsansach.thuvienanh (`MaSP`,`path`) values ('$id_pro','$value')");
        }
       if($product_query){
        header('Location: ./product.php');
    }else{
        echo 'Thêm mới không thành công';
    }
    }
    
?>
<?php include './header.php'?>
<div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-info">
                
                <div class="panel-body">
                    <form action="" method="POST" role="form" enctype="multipart/form-data">
                    <legend>Thêm mới sản phẩm</legend>

                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="" placeholder="Input field" name="tensp">
                    </div>

                    <div class="form-group">
                        <label for="">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" id="" placeholder="Input field" name="imagesp">
                    </div>

                    <div class="form-group">
                        <label for="">Ảnh mô tả</label>
                        <input type="file" class="form-control" id="" placeholder="Input field" name="imagesps[]" multiple>
                    </div>

                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="text" class="form-control" id="" placeholder="Input field" name="soluong">
                    </div>

                    <div class="form-group">
                        <label for="">Giá sản phẩm</label>
                        <input type="text" class="form-control" id="" placeholder="Input field" name="giasp">
                    </div>

                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea name="mota" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <select class="form-control" name="madm" required="required">
                        <?php
                        foreach($category as $key => $value)
                        {
                        ?>
                        <option value="<?php echo $value['MaDM']?>"><?php echo $value['TenDM'] ?></option>
                    <?php } ?>
                    </select>
                                    </div>

                    <div class="form-group">
                        <label for="">Tên đơn vị</label>
                        <select class="form-control" name="madv" required="required">
                        <?php
                        foreach($unit as $key => $value)
                        {
                        ?>
                        <option value="<?php echo $value['MaDV']?>"><?php echo $value['TenDV'] ?></option>
                    <?php } ?>
                    </select>
                                    </div>

                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <?php include './footer.php'?>
