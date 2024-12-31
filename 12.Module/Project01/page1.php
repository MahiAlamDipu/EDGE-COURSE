<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page 1</title>
</head>
<body>
    <h1>Welcome to Page 1</h1>
    <p>This is the first page. You can go to the second page by clicking the link below:</p>
    
    <!-- Link to Page 2 -->
     <?php $Base_Url = "/EDGE-RUET-CSE-RUETCSEB0101/12.Module/Project01/"?>

    <a href= "  <?php echo $Base_Url."/home"; ?>  "> Go to Home</a>

  

</body>
</html>

