<?php

namespace Wiki;

class WikiTextTokenStyler
{
    public function pageNameThatExists($page, $url)
    {
        return '<a href="#" style="color:black;" href="'.$url.'">'.$page.'</a>';
    }
    
    public function pageNameThatDoesNotExist($page, $url)
    {
        return '<a href="#" style="color:red;" href="'.$url.'">'.$page.'</a>';
    }
}