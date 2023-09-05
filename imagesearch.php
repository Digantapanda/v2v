<?php
header("Content-type:text/html;charset=utf-8");
　　// Test PHP to execute python code
　　$a = 5;
　　$b = 8;
　　$c  ='Davidszhou's PHP operates a python script with parameters and returns the result';
　　$d = urlencode($c);
　　unset($out);
　　$c = exec("C:\python35\python plug/index.py {$a} {$b} {$d}",$out,$res);
　　print_r(urldecode($out[0]));
　　echo "<br>";
　　echo  'Whether the external program runs successfully:'.$res."(0 means success, 1 means failure)";
 ?>
