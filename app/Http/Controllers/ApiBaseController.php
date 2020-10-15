<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\UserProviderTrait;
use Gloudemans\Shoppingcart\Facades\Cart;

class ApiBaseController extends Controller
{
    use UserProviderTrait;
}

