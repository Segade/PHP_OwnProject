<?
$nome= "../bbb/novo_dir";

if(!is_dir($nome)){
//  mkdir($nome, 0777, true);
 mkdir($nome, 0777);
}else{
echo "Ya existe ese directorio\n";
} 
?>