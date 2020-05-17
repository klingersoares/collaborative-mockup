<?php

namespace App\Http\Controllers;

use App\MongoModels\Log;
use App\Projeto;
use App\ProjetoUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class ProjetoController extends Controller {

    public function novoProjeto(Request $request) {

        if ($request->get('nomeProjeto') == '') {
            return redirect('home')->with(['message' => 'Nome do projeto é obrigatório', 'type' => 'error']);
        }

        $urlProjeto = 'proj_' . $request->get('nomeProjeto') . md5(time());
        $urlProjeto = preg_replace("/[^a-zA-Z0-9]+/", "", $urlProjeto);

        $projeto = Projeto::create([
            'nome' => $request->get('nomeProjeto'),
            'url' => $urlProjeto,
        ]);

        ProjetoUser::create([
            'idProjeto' => $projeto->id,
            'idUser' => Auth::user()->id,
            'tipo' => 'P',
        ]);

        $caminhoTemplate = env('APP_ENV') == 'production' ? 'template_projeto' : 'template_dev';

        File::copyDirectory(Storage::disk('webstrates')->path('') . $caminhoTemplate, Storage::disk('webstrates')->path('') . $urlProjeto);

        //  dd();
        // $command, string $cwd = null, array $env = null, $input = null, ?float $timeout = 60
        $process = new Process(['webstratesfs', '--id=' . $urlProjeto, '--insecure'], Storage::disk('webstrates')->path(''));
        // $process = new Process(['sh', 'test.sh']);
        $process->run(function () use ($process) {
            sleep(5);
            $process->stop(10, 1);
        });

        // executes after the command finishes
        // if (!$process->isSuccessful()) {
        //     dd($process->getOutput());
        //     throw new ProcessFailedException($process);
        // }
        $dadosLog = [
            'event' => 'projetoCriado',
            'project' => $projeto->url,
            'userName' => Auth::user()->name,
            'userId' => Auth::user()->id,
        ];

        $log = Log::create($dadosLog);
        // dd($process->getOutput());
        return redirect(route('editarProjeto', $projeto->url));
        //return redirect(env('URL_EDITOR') . $urlProjeto);

    }

    public function colaborarProjeto(Request $request) {

        try {

            if ($request->get('chaveColaboracao') == '') {
                return redirect('home')->with(['message' => 'Chave do projeto é obrigatório', 'type' => 'error']);
            }

            $projeto = Projeto::where([
                'url' => $request->get('chaveColaboracao'),
            ])->first();

            if ($projeto == null) {
                throw new \Exception('Erro! Projeto não encontrado');
            }
            $projetoUser = ProjetoUser::where([
                'idProjeto' => $projeto->id,
                'idUser' => Auth::user()->id,
            ])->first();

            if ($projetoUser != null) {
                throw new \Exception('Você já está colaborando no projeto ' . $projeto->nome);
            }

            ProjetoUser::create([
                'idProjeto' => $projeto->id,
                'idUser' => Auth::user()->id,
                'tipo' => 'C',
            ]);

            return redirect(route('editarProjeto', $projeto->url));

        } catch (\Exception $e) {
            return redirect('home')->with(['message' => $e->getMessage(), 'type' => 'error']);
        }

    }
    public function editarProjeto($idProjeto) {
        try {

            $projeto = Projeto::join('tbl_projeto_user', 'tbl_projeto.id', 'tbl_projeto_user.idProjeto')
                ->where('tbl_projeto_user.idUser', Auth::user()->id)
                ->where('tbl_projeto.url', $idProjeto)
                ->first();

            if ($projeto == null) {
                return redirect('home')->with(['message' => 'Você não possui permissão nesse projeto', 'type' => 'error']);
            }

            $data = [
                'urlProjeto' => env('URL_EDITOR') . $idProjeto,
                'projeto' => $projeto,
            ];

            $dadosLog = [
                'event' => 'acessoProjeto',
                'project' => $projeto->url,
                'userName' => Auth::user()->name,
                'userId' => Auth::user()->id,
            ];
            $log = Log::create($dadosLog);
            return view('editor', $data);
        } catch (Exception $e) {
            return redirect('home')->with(['message' => $e->getMessage(), 'type' => 'error']);
        }

    }

    public function salvarAlteracao(Request $request) {
        try {

            $dadosLog = $request->all() + ['userId' => Auth::user()->id, 'userName' => Auth::user()->name];

            $log = Log::create($dadosLog);

            return response()->json([$log]);
            dd($request->get('pid'));

        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function verificarSessao() {
        try {
            return response()->json([true], 200);
        } catch (\Exception $e) {
            return response()->json([false], 401);
        }
    }

}
