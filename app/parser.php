<?php
 
$nt = microtime(true); 
$page = file_get_contents ("http://yandex.ru"); 
 
if (!$page)
{
    echo "Нет связи с сервером";
    } 
else 

{
  $start_block_pos = strpos($page, "<div class=\"inline-stocks\">");
  $begin = substr($page, $start_block_pos);
  $end_block_pos = strpos($begin, "</div></td>");
  $currency = "<br><span><span class=\"inline-stocks__diff\">" . substr($begin, 0, $end_block_pos); 
  $currency = preg_replace('/<a(?:\\s[^<>]*)?>/i', '', $currency);
  $currency = preg_replace('/<div(?:\\s[^<>]*)?>/i', '', $currency);
  $currency = str_replace("</div>", "<br>", $currency);
  $currency = str_replace("</a>", "&nbsp&nbsp", $currency);
 
if (!$currency) 
{
    echo "Данные не получены";
}
else
{
echo $currency; 
echo '<br>time=' . (microtime(true) - $nt) . ' сек'; 
}
 
 }
 
 ?>