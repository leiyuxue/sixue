<?php
function text_help(){
    return 'ok';
}

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}


