<?php
    include '../db/config.php';
$unit = mysqli_query($connect, "SELECT * FROM nongsansach.donvitinh");

// phân trang danh mục
// buoc 1 tinh tong so ban ghi
$total= mysqli_num_rows($unit);
// buoc 2 thiet lap so ban ghi tren 1 trang
$limit=3;
// buoc 3 tinh so trang 
$page=ceil($total/$limit);
// buoc 4 lay trang hien tai
$cr_unit = (isset($_GET['page'])? $_GET['page'] : 1);
// buoc 4 tinh start
$start =($cr_unit - 1)*$limit;
// buoc 5 query du lieu
$unit = mysqli_query($connect, "SELECT * FROM nongsansach.donvitinh LIMIT $start,$limit");
    if(isset($_POST['tendv'])){
        $tendv= $_POST['tendv'];

        $sql="INSERT INTO nongsansach.donvitinh(TenDV) VALUES ('$tendv') ";
       $unit_query =mysqli_query($connect,$sql);
       if($unit_query){
        header('Location: ./unit.php');
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
                
                <div class="panel-body">
                    <form action="" method="POST" role="form">
                    <legend>Thêm mới đơn vị</legend>

                    <div class="form-group">
                        <label for="">Tên đơn vị</label>
                        <input type="text" class="form-control" id="" placeholder="Input field" name="tendv">
                    </div>


                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Danh sách đơn vị</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên đơn vị</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($unit as $key => $value): ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $value['TenDV'] ?></td>
                                    
                                    <td> 
                                        <a href="./edit-unit.php?madv=<?php echo $value['MaDV']?>" class="btn btn-outline-success" title="Sửa"><span class="fas fa-edit"></span></a>
                                         <a href="./delete-unit.php?madv=<?php echo $value['MaDV']?>" class="btn btn-outline-danger" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa không')"><span class="fas fa-window-close"></span></a>        
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if($cr_unit - 1 >0){?>
                        <li class="page-item">
                        <a class="page-link" href="unit.php?page=<?php echo $cr_unit - 1 ?>">Previous</a>
                        </li>
                        <?php } ?>
                        <?php for ($i = 1; $i <=$page; $i++) {?>
                            <li class="page-item <?php echo (($cr_unit == $i)? 'active': '' )?>"><a class="page-link" href="unit.php?page=<?php echo $i?>"><?php echo $i ?></a></li> 
                            <?php }?>
                        <?php if($cr_unit + 1 <=$page){?>
                        <li class="page-item">
                        <a class="page-link" href="unit.php?page=<?php echo $cr_unit + 1 ?>">Next</a>
                        </li>
                        <?php } ?>
                    </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php include './footer.php'?>
    