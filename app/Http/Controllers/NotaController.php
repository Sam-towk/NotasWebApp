<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Str;

class NotaController extends Controller
{
    public function store(Request $request)
    {
    $request -> validate([
        'titulo'=>'required|string|max:255',
        'conteudo'=> 'required|string',
    ]);
    $slug = Str::slug($request ->titulo);
    $nomeArquivo ="notas/" .$slug . ".md";
    $conteudoMarkdown = $request -> conteudo;
    Storage::disk('local')->put($nomeArquivo, $conteudoMarkdown);
    return redirect()->route('dashboard')->with('status','Nota criada');
    }
    
    public function index()
    {
        $arquivos = Storage::disk('local')->files('notas');
        $notas =[];
        foreach($arquivos as $arquivo){
            $slug = str_replace(['notas/','.md'],'', $arquivo);
            $titulo = ucfirst(str_replace('-', '', $slug));
            $notas[]=[
                'slug' => $slug,
                'titulo' => $titulo
            ];
        }
        return view('dashboard', compact('notas'));
    }

    public function show($slug){
        $nomeArquivo ="notas/" . $slug .".md";
        if(!Storage::disk('local') -> exists($nomeArquivo)){
            abort(404);
        }
        $conteudoCru = Storage::disk('local') ->get($nomeArquivo);
        return view('notas.show',[
            'titulo'=> ucfirst(str_replace('-','', $slug)),
            'conteudo' => $conteudoCru,
            'slug' => $slug
        ]);;

    }
    
    public function destroy($slug){
         $nomeArquivo = "notas/" .$slug . ".md";

         if (Storage::disk('local')-> exists($nomeArquivo)) {
            Storage::disk('local')-> delete($nomeArquivo);
            return redirect()->route('dashboard')->with('error', 'Nota excluida com sucesso');
         }
        return redirect()->route('dashboard')->with('error', 'Nota não encontrada');
    }
}
