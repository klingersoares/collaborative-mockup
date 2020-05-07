<?php

namespace App\Http\Controllers;

use App\Projeto;
use App\ProjetoUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class ProjetoController extends Controller {

    public function novoProjeto(Request $request) {

        if ($request->get('nomeProjeto') == '') {
            return redirect(back(302));
        }

        $urlProjeto = 'proj_' . $request->get('nomeProjeto') . md5(time());

        $projeto = Projeto::create([
            'nome' => $request->get('nomeProjeto'),
            'url' => $urlProjeto,
        ]);

        ProjetoUser::create([
            'idProjeto' => $projeto->id,
            'idUser' => Auth::user()->id,
            'tipo' => 'P'
        ]);


        $caminhoTemplate = env('APP_ENV') == 'production' ? 'template_projeto' : 'template_dev';

        File::copyDirectory(Storage::disk('webstrates')->path('') . $caminhoTemplate, Storage::disk('webstrates')->path('') . $urlProjeto);

        //  dd();
        // $command, string $cwd = null, array $env = null, $input = null, ?float $timeout = 60
        $process = new Process(['webstratesfs', '--id=' . $urlProjeto, '--insecure'], Storage::disk('webstrates')->path(''));
        // $process = new Process(['sh', 'test.sh']);
        $process->run(function () use ($process) {
            // sleep(5);
            $process->stop(10, 1);
        });

        // executes after the command finishes
        // if (!$process->isSuccessful()) {
        //     dd($process->getOutput());
        //     throw new ProcessFailedException($process);
        // }

        // dd($process->getOutput());

        return redirect(env('URL_EDITOR') . $urlProjeto);

    }

    public function editarProjeto($idProjeto){
        return view('editor',['urlProjeto'=>env('URL_EDITOR').$idProjeto]);
    }

    public function salvarAlteracao(Request $request){
        try{

            dd($request->get('pid'));



        }catch(\Exception $e){

        }
    }

}
