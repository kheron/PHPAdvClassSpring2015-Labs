<?php

function load_lib($base) {
    
    $baseName = explode( '\\', $base );
    $class = end( $baseName ); 
     
    include 'lib/'.$class . '.php';
    
    var_dump($class);   
};
spl_autoload_register('load_lib');