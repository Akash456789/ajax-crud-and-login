<?php
include('conn.php');
$result = mysqli_query($con, "SELECT * FROM stu2");
?>
<table class="table table-bordered">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Gender</th>
    <th>Language</th>
    <th>City</th>
    <th>Photo</th>
    <th>Action</th>
  </tr>
<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['gender']; ?></td>
    <td><?php echo $row['language']; ?></td>
    <td><?php echo $row['city']; ?></td>
    <td><img src="<?php echo $row['photo']; ?>" width="70"></td>
    <td>
        <button class="btn btn-warning btn-sm updateBtn"
            data-id="<?php echo $row['id']; ?>"
            data-name="<?php echo $row['name']; ?>"
            data-gender="<?php echo $row['gender']; ?>"
            data-language="<?php echo $row['language']; ?>"
            data-city="<?php echo $row['city']; ?>"
            data-photo="<?php echo $row['photo']; ?>"
        >Update</button>
        <button class="btn btn-danger btn-sm deleteBtn" data-id="<?php echo $row['id']; ?>">Delete</button>
    </td>
</tr>
<?php } ?>
</table>
