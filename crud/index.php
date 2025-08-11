<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX CRUD with Modal Update</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="p-3">

<h2>Add Student</h2>
<form id="myform" enctype="multipart/form-data">
    Name: <input type="text" name="name" class="form-control"><br>
    Gender:
    <input type="radio" value="male" name="gender"> Male
    <input type="radio" value="female" name="gender"> Female<br><br>
    Language:
    <input type="checkbox" value="Hindi" name="language[]"> Hindi
    <input type="checkbox" value="English" name="language[]"> English<br><br>
    City:
    <select name="city" class="form-control">
        <option value="Muzaffarnagar">Muzaffarnagar</option>
        <option value="Noida">Noida</option>
        <option value="Delhi">Delhi</option>
    </select><br>
    Photo: <input type="file" name="photo" class="form-control"><br>
    <button type="submit" class="btn btn-success">Submit</button>
</form>

<hr>
<h3>Student List</h3>
<div id="studentTable"></div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="updateForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Update Student</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="update_id">

            Name: <input type="text" name="name" id="update_name" class="form-control"><br>

            Gender:
            <input type="radio" value="male" name="gender" id="update_male"> Male
            <input type="radio" value="female" name="gender" id="update_female"> Female<br><br>

            Language:
            <input type="checkbox" value="Hindi" name="language[]" id="update_lang_hindi"> Hindi
            <input type="checkbox" value="English" name="language[]" id="update_lang_english"> English<br><br>

            City:
            <select name="city" id="update_city" class="form-control">
              <option value="Muzaffarnagar">Muzaffarnagar</option>
              <option value="Noida">Noida</option>
              <option value="Delhi">Delhi</option>
            </select><br>

            Photo: <input type="file" name="photo" class="form-control"><br>
            <img id="update_preview" src="" width="100">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

    loadData();

    // Add Data
    $('#myform').on('submit', function(e){
        e.preventDefault();
        var form_data=new FormData(this);
        $.ajax({
            url:'save.php',
            type:'POST',
            data:form_data,
            contentType:false,
            processData:false,
            success:function(response){
                alert(response);
                $('#myform')[0].reset();
                loadData();
            }
        });
    });

    // Load Table Data
    function loadData(){
        $.ajax({
            url:'fetch.php',
            type:'GET',
            success:function(data){
                $('#studentTable').html(data);

                // Delete
                $('.deleteBtn').click(function(){
                    var id = $(this).data('id');
                    if(confirm("Are you sure you want to delete this record?")){
                        $.post('delete.php', {id:id}, function(res){
                            alert(res);
                            loadData();
                        });
                    }
                });

                // Update Modal Open
                $('.updateBtn').click(function(){
                    $('#update_id').val($(this).data('id'));
                    $('#update_name').val($(this).data('name'));

                    // Gender
                    var gender = $(this).data('gender');
                    $('#update_male').prop('checked', gender === 'male');
                    $('#update_female').prop('checked', gender === 'female');

                    // Language
                    var langs = $(this).data('language').split(',');
                    $('#update_lang_hindi').prop('checked', langs.includes('Hindi'));
                    $('#update_lang_english').prop('checked', langs.includes('English'));

                    // City
                    $('#update_city').val($(this).data('city'));

                    // Photo preview
                    $('#update_preview').attr('src', $(this).data('photo'));

                    $('#updateModal').modal('show');
                });
            }
        });
    }

    // Update Data
    $('#updateForm').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url:'update.php',
            type:'POST',
            data:formData,
            contentType:false,
            processData:false,
            success:function(res){
                alert(res);
                $('#updateModal').modal('hide');
                loadData();
            }
        });
    });

});
</script>

</body>
</html>
