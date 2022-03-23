<?php
include '../../../db/config.php';
// SELECT * FROM district inner join province on province.id = district.province_id where name = 'Tỉnh Hà Nội';
$sql2 = "SELECT * FROM diachi.district inner join diachi.province on province.id = district.province_id where name = '" . $_POST['provinceid'] . "' order by `named`";
// $sql2 = "SELECT * FROM diachi.district where province_id =" . $_POST['provinceid'];
$query2 = mysqli_query($connect, $sql2);
$district = mysqli_fetch_all($query2, 1);
foreach ($district as $row) {
?>
    <option onclick="openTransfer(event,'ward')" value="<?= $row['named'] ?>"><?= $row['named'] ?></option>
<?php
}
?>