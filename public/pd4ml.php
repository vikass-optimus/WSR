<?php  
    $evaluation = 1;  
    $java = "java";  
      
    $url = base64_decode($_GET['url']) . '?layout=pdf';  
      
    if ( $evaluation == 1 ) {  
    $jar = "../pd4ml_php_wrapper/pd4ml_demo.jar";  
    } else {  
    $jar = "../pd4ml_php_wrapper/pd4ml.jar";  
    }  
      
    header("Pragma: cache");  
    header("Expires: 0");  
    header("Cache-control: private");  
    header('Content-type: application/pdf');   
    header('Content-disposition: inline');   
      
    if ( strpos(php_uname(), 'Windows' ) !== FALSE) {   
    // server platform: Windows  
    $jar = preg_replace('/\//', "\\", $jar);  
    $cmdline = "$java -Xmx512m -cp $jar Pd4Cmd \"$url\" 800 A4";  
    } else {  
    // server platform: UNIX-derived  
    $cmdline = "$java -Xmx512m -Djava.awt.headless=true -cp $jar Pd4Cmd \"$url\" 800 A4";  
    }  
      
    // see for more command-line parameters: http://pd4ml.com/html-to-pdf-command-line-tool.htm  
      
    passthru( $cmdline );  
?>  