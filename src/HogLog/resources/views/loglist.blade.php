<html>
<body>
<h1>Read all the log files</h1>

<ul>
<?php
$urlBase = \Request::url();
foreach($hlfiles as $name => $log) {
    echo "<li><a href='{$urlBase}\\log\\{$name}'>{$name}</a></li>";
}
?>
</ul>

</body>
</html>

