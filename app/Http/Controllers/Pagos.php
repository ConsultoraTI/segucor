<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pagos extends Controller
{

    public function lista_presupuestos_para_pagos()
    {


        return view('back_end.pagos.lista_pagos');
    }

    public function lista_presupuestos_archivo_pagos(){

    }

}
