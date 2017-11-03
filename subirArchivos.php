<?php
//usamos heredoc
$formulario = <<< html
    <form enctype='multipart/form-data' name='subida' method='post' action='subirArchivos2.php'>
    <input type='file' name='archivo'/>
    <input type='submit' name='opcion' value='subir'/>
    </form>
html;
echo $formulario;
?>
