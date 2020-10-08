<?php
require_once("./../_configure.php"); // Carrega as funções e configurações globais
define('MAKER',URL.'MAKER');

$r=SqlQuery('SELECT TABLE_NAME, TABLE_ROWS, AUTO_INCREMENT, CREATE_TIME, UPDATE_TIME, TABLE_COMMENT 
    FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = "'.DBNAME.'"
');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<table width=* class="table table-striped">
<thead><tr><th>Tabela<th>Campos<th>Registros<th>Criação<th>Atualização<th>DETALHES<th>Opções</tr></thead>

<?php
while($l=$r->fetch(PDO::FETCH_ASSOC)){
    echo '<tr><td>'.$l['TABLE_NAME'];
    echo '<td>'.$l['TABLE_ROWS'];
    echo '<td>'.$l['AUTO_INCREMENT'];
    echo '<td>'.$l['CREATE_TIME'];
    echo '<td>'.$l['UPDATE_TIME'];
    echo '<td>'.$l['TABLE_COMMENT'];
    echo "<td>";
    echo "<a class='btn btn-warning' href='list_view.php?table=".$l['TABLE_NAME']."'>LIST</a> ";
    echo "<a class='btn btn-primary' href='form_view.php?table=".$l['TABLE_NAME']."'>FORM</a> ";
    echo "<a class='btn btn-info' href='print_view.php?table=".$l['TABLE_NAME']."'>PRINT</a> ";
    echo "<a class='btn btn-success' href='make_control.php?table=".$l['TABLE_NAME']."'>CONTROL</a> ";
    echo "</tr>";
}
echo '</table>';