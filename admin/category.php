<?php
    include '../db/config.php';
$category = mysqli_query($connect, "SELECT * FROM nongsansach.danhmuc");

// phân trang danh mục
// buoc 1 tinh tong so ban ghi
$total= mysqli_num_rows($category);
// buoc 2 thiet lap so ban ghi tren 1 trang
$limit=3;
// buoc 3 tinh so trang 
$page=ceil($total/$limit);
// buoc 4 lay trang hien tai
$cr_page = (isset($_GET['page'])? $_GET['page'] : 1);
// buoc 4 tinh start
$start =($cr_page - 1)*$limit;
// buoc 5 query du lieu
$category = mysqli_query($connect, "SELECT * FROM nongsansach.danhmuc LIMIT $start,$limit");

    if(isset($_POST['tendm'])){
        $tendm = $_POST['tendm'];
        

        if(isset($_FILES['image'])){
            $file = $_FILES['image'];
            $file_name = $file['name'];
            move_uploaded_file($file['tmp_name'],'../uploads/'.$file_name);
        }
        
        $sql="INSERT INTO nongsansach.danhmuc(TenDM,HinhDD) VALUES ('$tendm','$file_name') ";
       $category_query = mysqli_query($connect,$sql);
       if($category_query){
        header('Location: ./category.php');
    }else{
        echo 'thêm không thành công';
    }
    }

?>
    <?php include './header.php'?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-info">
                <!-- <div class="panel-heading">
                    <h3 class="panel-title">Thêm mới</h3>
                </div> -->
                <div class="panel-body">
                    <form action="" method="POST" role="form" enctype="multipart/form-data">
                    <legend>Thêm mới danh mục</legend>

                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input type="text" class="form-control" id="" placeholder="Input field" name="tendm">
                    </div>

                    <div class="form-group">
                        <label for="">Hình đại diện</label>
                        <input type="file" class="form-control" id="" placeholder="Input field" name="image">
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Danh sách danh mục</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên danh mục</th>
                                    <th>Ảnh đại diện</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($category as $key => $value): ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $value['TenDM'] ?></td>
                                    <td><img src="../uploads/<?php echo $value['HinhDD'] ?>" alt="" width="100"></td>
                                    <td> 
                                        <a href="./edit-category.php?madm=<?php echo $value['MaDM']?>" class="btn btn-outline-success" title="Sửa"><span class=" fas fa-edit"></span></a>
                                         <a href="./delete.php?madm=<?php echo $value['MaDM']?>" class="btn btn-outline-danger" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa không')"><span class=" fas fa-window-close"></span></a>        
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if($cr_page - 1 >0){?>
                        <li class="page-item">
                        <a class="page-link" href="category.php?page=<?php echo $cr_page - 1 ?>">Previous</a>
                        </li>
                        <?php } ?>
                        <?php for ($i = 1; $i <=$page; $i++) {?>
                            <li class="page-item <?php echo (($cr_page == $i)? 'active': '' )?>"><a class="page-link" href="category.php?page=<?php echo $i?>"><?php echo $i ?></a></li> 
                            <?php }?>
                        <?php if($cr_page + 1 <=$page){?>
                        <li class="page-item">
                        <a class="page-link" href="category.php?page=<?php echo $cr_page + 1 ?>">Next</a>
                        </li>
                        <?php } ?>
                    </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php include './footer.php'?>