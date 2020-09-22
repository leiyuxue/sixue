<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product=$product;
    }
}
