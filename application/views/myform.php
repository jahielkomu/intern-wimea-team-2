<html>
<head>
<title>Form</title>
</head>
<body>
  <form method="POST" enctype="multipart/form-data">
  	<?php echo validation_errors(); ?>  
  	<h5>Name</h5> 
  	<input type = "text" name = "name" value = "<?php echo set_value('name'); ?>" />  
	<h5>Email</h5> 
  	<input type = "email" name = "email" value = "<?php echo set_value('email'); ?>" /> 
	  <input type="file" name="pdffile"  /> 
  	<div><input type = "submit" value = "Submit" /></div>  
  </form>  
</body>
</html>