<?php
$pr[':senha']=sha1('tmc@202020');
$pr[':senha']=password_hash($pr[':senha'],PASSWORD_DEFAULT);
echo $pr[':senha'];
echo '<br>============================';
phpinfo();
?>