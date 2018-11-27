<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <!-- include libraries(jQuery, bootstrap) -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" />
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- include summernote css/js-->
<link href="summernote.css" rel="stylesheet">
<script src="summernote.js"></script>
    
  
  <title>summernote-lite</title>
  <script type="text/javascript">
   $(document).ready(function() {
  $('#summernote').summernote(
  {
    height: 300,
    width: 900,                 // set editor height
    minHeight: 100,             // set minimum height of editor
    maxHeight: 600,             // set maximum height of editor
    focus: true                    // set focus to editable area after initializing summernote 
      
  });
});
  </script>
</head>
<body>
  <div id="summernote">Hello Summernote</div>
</body>
</html>