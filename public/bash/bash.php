<?php

$output = shell_exec("bash bash.sh");

$file = 'sample.txt';
echo $file.'\n';

file_put_contents($file, 'sample'.$output);
echo "<pre>$output</pre>";