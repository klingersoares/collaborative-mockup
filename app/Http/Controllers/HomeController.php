<?php

namespace App\Http\Controllers;

use App\Projeto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $projetos = Projeto::join('tbl_projeto_user', 'tbl_projeto.id', 'tbl_projeto_user.idProjeto')
                            ->where('tbl_projeto_user.idUser', '=', Auth::user()->id)->orderBy('tbl_projeto.nome')->get();

        return view('home',['projetos'=>$projetos]);
    }
}
