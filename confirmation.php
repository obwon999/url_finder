<?php include "upload_file.php" ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>URL Finder - Confirmation</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">

</head>

<body>

<div class="site-wrapper">
  <div class="site-wrapper-inner">
    <div class="cover-container">
      <div class="inner cover">
        <h1 class="cover-heading">Success!!!</h1><br />
        
        <a class="btn btn-primary btn-lg active" role="button" href="index.php">Upload Another File</a>
        
      </div>
    </div>
  </div>
</div>

<form action='export.php' method='post' name='frm'>
<input type="hidden" value="<?php echo $csv_output; ?>" name="csv_output">
</form>

<script language="JavaScript">
document.frm.submit();
</script>

</body>
</html>