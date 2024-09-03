<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Yonlendir extends Controller
{
    //


    public function store(Request $request)
    {
        // Kullanıcıdan verileri alma işlemleri
        $data = $request->all();
    
        // İşlemleri başarılı bir şekilde gerçekleştirdikten sonra başka bir porttaki URL'ye yönlendirme
        return redirect()->to('http://127.0.0.1:8000/');
    }
}
