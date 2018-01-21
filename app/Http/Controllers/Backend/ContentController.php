<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;


class ContentController extends Controller
{
	 public function content()
    {
    	return view('Backend.content.index');
    }

     public function createContentForm()
    {
        return view('Backend.content.create');
    }

}