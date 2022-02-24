<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <link rel="icon" href="dk.png">
  <title>Multiple Upload - www.dewankomputer.com</title>
  <link rel="stylesheet" href="css/bootstrap-4.3.1.min.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap-4.3.1.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
      <a class="navbar-brand text-white" href="index.php">
        Dewan Komputer
      </a>
    </nav>

    <div class="container">
        <h3 align="center" class="mt-3">Upload Multiple Image dengan Ajax dan Bootstrap Modal</h3>
        <div align="center">
             <button type="button" data-toggle="modal" data-target="#uploadModal" class="btn btn-info mt-3 mb-3">Upload Images</button>
        </div>

        <div class="row" id="gallery">
          <?php
            $images = glob("upload/*.*");
            foreach($images as $image){
                echo '<div class="col-md-1" align="center" ><img src="' . $image .'" width="100px" height="100px" style="margin-top:15px; padding:8px; border:1px solid #ccc;" /></div>';
            }
          ?>
        </div>
    </div>

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%">
        <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Upload Multiple Image</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                  <form method="post" id="upload_form">  
                      <label>Select Multiple Image</label>  
                      <input class="form-control" type="file" name="images[]" id="select_image" accept="image/*" multiple />  
                  </form>
              </div>
              <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <script>
      $(document).ready(function(){
          $('#select_image').change(function(){
               $('#upload_form').submit();
          });
          $('#upload_form').on('submit', function(e){
               e.preventDefault();
               $.ajax({
                    url :"upload.php",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){  
                         $('#select_image').val('');
                         $('#uploadModal').modal('hide');
                         $('#gallery').html(data);
                    }  
               })  
          });  
      });  
    </script>

</body>
</html>