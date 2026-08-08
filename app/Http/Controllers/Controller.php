<?php
namespace App\Http\Controllers;


use Illuminate\foundation\Auth\Access\AuthorizesRequests ;

abstract class Controller
{
    use AuthorizesRequests ;
}
