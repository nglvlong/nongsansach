<?php
include '../../../db/config.php';
$sql2 = "SELECT * FROM diachi.ward inner join diachi.district on ward.district_id = district.id where named = '" . $_POST['districtid'] . "' order by `namew`";
$query2 = mysqli_query($connect, $sql2);
$ward = mysqli_fetch_all($query2, 1);
foreach ($ward as $row) {
?>
    <option value="<?= $row['namew'] ?>"> <?= $row['namew'] ?></option>
<?php
}
?>