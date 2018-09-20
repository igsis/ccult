<?php

namespace ccult\Http\Controllers;

use Illuminate\Http\Request;

class UploadPjController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaJuridica');
    }
}
