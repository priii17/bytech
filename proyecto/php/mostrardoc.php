<?php


$lista=null;
$carpeta=opendir("../documentos");

while($elemento=readdir($carpeta)){

if($elemento !='.' && $elemento !='..'){
if(is_dir("../documentos/".$elemento)){

    $lista .="<li><a href='../documentos/$elemento' target='_blank'>$elemento/</a></li>";
    
    }else{
        
    $lista .="<li><a href='../documentos/$elemento' target='_blank'>$elemento</a></li>";

    }

}
}
?>
