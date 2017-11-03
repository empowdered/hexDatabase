<?php
header("Content-Type: text/html; charset=utf-8");

include_once('conexion.php');
include_once("hex2bin.php");
//include_once("conv32bits.php");

$opcion = $_POST["opcion"];

print_r($_FILES);

echo "<br/>";

$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$tamano = $_FILES['archivo']['size'];
$temporal = $_FILES['archivo']['tmp_name'];
//$rutaFinal ="C:\\xamppx\\htdocs\\csx\\crearDirectorios\\".$nombre;
$rutaFinal = "C:\\AppServ\\www\\prueba2\\" . $nombre;
$rutaCopia = "C:\\AppServ\\www\\prueba2\\copias\\" . $nombre;

move_to($temporal,$rutaFinal);
//$temporal = serialize($temporal);
$archivo = fread(fopen($rutaFinal,"r"), filesize($rutaFinal));
//var_dump($archivo);

//$documento = bin2hex(addslashes($archivo));
$documento = bin2hex($archivo);
//$documento = pack("H",$documento);

//header('Content-Disposition: attachment; filename="'.$documento.'"');
//echo "<a href='".$archivo."'>documento</a>";
//$documento2 = hex2bin($documento);



//var_dump($documento);
//$archivo = ms_escape_string($archivo);

if($opcion!=""){
    
    $consulta = "insert into archivo([nbArchivo],[tipoArchivo],[nbTemporal],[tamanoArchivo],[contenido]) values";
    //$consulta .= "('$nombre','$tipo',$tamano,NULL,CONVERT(VARBINARY(max),$archivo))";
    $consulta .= "('$nombre','$tipo','$temporal',$tamano,'$documento');";
    
    //echo $consulta;
    
//ob_start();   
    $recurso = NULL;
    //$recurso = odbc_exec($connSqlsrv,$consulta);
    $recurso = mssql_query($consulta);
    
    if($recurso!=NULL){
        printf("consulta ejecutada correctamente");
        //header('Location:subirArchivos.php');
    }else{
        //printf("Error, esto es un error %s, con este id %s",odbc_error(),odbc_errormsg());
        printf("Error, esto es un error");
    }
    //vamos a listar el archivo
    
    $registros = "select * from archivo";
    $recursos = mssql_query($registros);
    while($fila=mssql_fetch_array($recursos))
    {
        echo "Nombre Archivo: " .$fila['nbArchivo'] ."<hr/>";
        echo "Tipo Archivo: " .$fila['tipoArchivo'] ."<hr/>";
        echo "Temporal: " .$fila['nbTemporal'] ."<hr/>";
        echo "Tamaño: " .$fila['tamanoArchivo'] ."<hr/>";
        echo "String hexadecimal: " .hex2bin($fila['contenido']) ."<hr/>";
        echo "Tamaño de filesize: ". filesize($contenedorArchivo) . "<hr/>";
        $contenedorArchivo = hex2bin($fila['contenido']);
        
        $archivoNuevo = fopen($rutaCopia,"w");
        fwrite($archivoNuevo,$contenedorArchivo);
        fclose($archivoNuevo);
    }
    
    
//ob_flush();
    
}


function move_to($origen,$destino)
{ 
  copy($origen,$destino); 
  unlink($origen); 
}
function prepareImageDBString($filepath)
{
    $out = 'null';
    $handle = @fopen($filepath, 'rb');
    if ($handle)
    {
        $content = @fread($handle, filesize($filepath));
        $content = bin2hex($content);
        @fclose($handle);
        $out = "0x".$content;
    }
    return $out;
}

mssql_close($conexion);

$_POST = array();
$_FILES = array();
?>