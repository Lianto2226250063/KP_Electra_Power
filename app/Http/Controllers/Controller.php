<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Acces\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        
    }
}
