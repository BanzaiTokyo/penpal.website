<?php
$request='select  count(distinct(c.code))
from countries as c join pro_membersu as m on c.code=m.country;';
$res=mysql_query($request);
echo mysql_result($res, 0);
?>