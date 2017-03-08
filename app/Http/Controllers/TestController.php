<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\MyClass\My;

class TestController extends Controller
{
    private $myClass;

	public function __construct(My $my)
	{
		$this->myClass = $my;
	}
	
	public function index()
	{
		return $this->myClass->say();
	}
}
