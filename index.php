<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>URL Finder</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">

</head>

<body>

<div class="site-wrapper">
  <div class="site-wrapper-inner">
    <div class="cover-container">
      <div class="inner cover">
        <h1 class="cover-heading">Choose file to upload and convert</h1><br />
        
        <form role="form" action="processURLs.php" method="post" enctype="multipart/form-data" class="form-inline">
            <div class="form-group" style="margin-left:100px">
                <input type="file" name="file" id="file">
            </div>
	
			<br /><br /><br />
            
            <div class="row">
            	<button class="btn btn-lg btn-primary" name="submit" type="submit">Submit</button>
            </div>
    	</form>
      </div>
    </div>
  </div>
</div>

</body>
</html>