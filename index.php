<?php
    function html2txt($document){ 
        $search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript 
                 '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags 
                 '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly 
                 '@<![\s\S]*?--[ \t\n\r]*>@');      // Strip multi-line comments including     CDATA ); 
        $text = preg_replace($search, '', $document); 
        return $text; 
    }
    function nl2br2($string) { 
        $string = str_replace(array('\n'), "", $string); 
        return $string; 
    }

    $text = isset($_POST['txt1']) ? $_POST['txt1'] : null;
    $posttext = strrpos( $text, 'content')+10;
    $endline = strrpos( $text, 'device_type');
    $endline = $endline-$posttext;
    $text = substr ($text , $posttext ,$endline);

    $text =  str_replace(array('\n', '","'), "", $text);
    $text = nl2br2($text);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<style>
    html {
  height:100%;
}

body {
  margin:0;
}

.bg {
  animation:slide 3s ease-in-out infinite alternate;
  background-image: linear-gradient(-60deg, #6c3 50%, #09f 50%);
  bottom:0;
  left:-50%;
  opacity:.5;
  position:fixed;
  right:-50%;
  top:0;
  z-index:-1;
}

.bg2 {
  animation-direction:alternate-reverse;
  animation-duration:4s;
}

.bg3 {
  animation-duration:5s;
}

.content {
  background-color:rgba(255,255,255,.8);
  border-radius:.25em;
  box-shadow:0 0 .25em rgba(0,0,0,.25);
  box-sizing:border-box;
  left:50%;
  padding:10vmin;
  position:fixed;
  text-align:center;
  top:50%;
  transform:translate(-50%, -50%);
}

h1 {
  font-family:monospace;
}

@keyframes slide {
  0% {
    transform:translateX(-25%);
  }
  100% {
    transform:translateX(25%);
  }
}
</style>
<body>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
<div class="content">
<form action="" method="POST">
    <textarea name="txt1"cols="50" rows="10"></textarea>
    <input type="submit" class="btn btn-primary">
</form>
<div class="result">
    <?php
        if($text==null)
            echo "No result";
        else 
            echo $text;
    ?>
</div></div>

</body>
</html>