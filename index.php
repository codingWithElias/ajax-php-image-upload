<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Image Upload Using AJAX & PHP</title>
	<style>
		#errorMs {
			color: #a00;
		}
		.gallery img{
            width: 300px;
		}
	</style>
</head>
<body>

	<p id="errorMs"></p>
	<form action="upload.php"
	      id="form" 
	      method="post"
	      enctype="multipart/form-data">

		<input type="file"
		       id="myImage">

		<input type="submit" 
		       id="submit" 
		       value="Upload">
	</form><br>

	<div class="gallery">
		<img src="uploads/default-image.jpg" id="preImg">
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
    $(document).ready(function(){
      
      $("#submit").click(function(e){
      	e.preventDefault();

      	let form_data = new FormData();
      	let img = $("#myImage")[0].files;
 
        // Check image selected or not
        if(img.length > 0){
        	form_data.append('my_image', img[0]);

        	$.ajax({
        		url: 'upload.php',
        		type: 'post',
        		data: form_data,
        		contentType: false,
                processData: false,
                success: function(res){
                	const data = JSON.parse(res);

                	if (data.error != 1) {
                       let path = "uploads/"+data.src;
                       $("#preImg").attr("src", path);
                       $("#preImg").fadeOut(1).fadeIn(1000);
                       $("#myImage").val('');

                	}else {
                		$("#errorMs").text(data.em);
                	}
                }

        	});
         
        }else {
           $("#errorMs").text("Please select an image.");
        }
      });
        
    });
	</script>
</body>
</html>