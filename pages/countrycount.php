<?php
$request='select  count(distinct(c.id_country))
from countries as c join members as m on c.id_country=m.country;';
$res=mysql_query($request);
echo mysql_result($res, 0);
?>