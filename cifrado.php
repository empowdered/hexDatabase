<?php
function ssl_encrypt($source,$type,$key){

$maxlength=245;
$output='';
while($source){
  $input= substr($source,0,$maxlength);
  $source=substr($source,$maxlength);
  if($type=='private'){
    $ok= openssl_private_encrypt($input,$encrypted,$key);
  }else{
    $ok= openssl_public_encrypt($input,$encrypted,$key);
  }

  $output.=$encrypted;
}
return $output;
}
?>