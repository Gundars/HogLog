<?php

$log = $hlfiles[$logfile];
?>
<html>
<body>
<h3><a href=/<?= config('hoglog.rootPrefix', '/hoglog/') ?>><< back</a></h3>
<h1><?= $log['name'] ?></h1>
<h4>Size: <?= $log['hsize']?> | Modified: <?= date('r', $log['modified']) ?></h4>

<?php
  dd($logdata);
?>

</body>
</html>