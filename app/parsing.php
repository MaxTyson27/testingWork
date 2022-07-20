<?php
 
//header ("Content-Type: text/html; charset=utf-8");  //раскомментировать строку, если использовать отдельным файтом, если include, то комментирование оставить
 
$nt = microtime(true); //если хотим знать время отработки скрипта, то раскомментируем это и строку 36
$page = file_get_contents ("http://yandex.ru"); //сливаем весь контент yandex.ru в строку $page
 
if (!$page)                         // если строка $page вдруг пустая, то выдаем: нет связи с сервером, хотя причиной этому может быть не только это, например скрипт запущен на эмуляторе сервера, а интернет соединения нет и т.д.
{
    echo "Нет связи с сервером";
    } else 
                               // иначе отрабатываем скрипт
{
 
 // нахождение блока с курсами
$start_block_pos = strpos($page, "<div class=\"inline-stocks\">"); //начальная позиция блока 
$begin = substr($page, $start_block_pos);                           // обрезаем то, что было перед начальной позицией блока
$end_block_pos = strpos($begin, "</div></td>");                     // конечная позиция блока
$currency = "<br><span><span class=\"inline-stocks__diff\">" . substr($begin, 0, $end_block_pos); // обрезаем все, что после блока + добавляем, что лишнее обрезали для валидности html
 
$currency = preg_replace('/<a(?:\\s[^<>]*)?>/i', '', $currency); // удаляем все гиперссылки, если не надо, то можно закомментировать строку и не забыть закомментировать при этом строку 24
$currency = preg_replace('/<div(?:\\s[^<>]*)?>/i', '', $currency); // удаляем yandex блоки, можно это закомментировать и с CSS прописать свои правила для yandex блоков и не забыть тогда закомментировать строку 23
$currency = str_replace("</div>", "<br>", $currency); // удаляем остатки дивов и вместо них делаем перевод строки (нужно закомментировать, если оставить строку 21
$currency = str_replace("</a>", "&nbsp&nbsp", $currency); // удаляем остатки ссылок и вместо них делаем 2 пробела (нужно закомментировать, если оставить строку 20
 
if (!$currency)                                        // если по какой-то причине данные не пришли, то пишем - данные не получены
{
    echo "Данные не получены";
}
else
{
echo $currency;                                             // если все хорошо, то выдаем котировки
echo '<br>time=' . (microtime(true) - $nt) . ' сек';       // если надо знать время исполнения скрипта, то раскомментировать вместе с строкой 4
}
 
 }
 
 ?>