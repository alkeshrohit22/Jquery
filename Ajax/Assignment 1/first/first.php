<?php
$value = "";
$desc = $_POST['textArea'];
if ($desc == null && $desc == ""){
    $value .= "Please Enter Text in TexrArea";
} else {
    $value .= $desc;
}
echo $value;
?>