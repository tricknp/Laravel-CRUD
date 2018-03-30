<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Produto::all();

        return view('produtos_lista', ['produtos' => $dados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produtos_form', ['acao' => 1]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nome' => 'required|unique:produtos|min:4|max:100',
            'marca' => 'required',
            'quant' => 'required|numeric',
            'preco' => 'required|numeric'
        ]);

        $dados = $request->all();

        $prod = Produto::create($dados);

        if ($prod) {
            return redirect()->route('produtos.index')->with('status', 'Produto ' . $request->nome . ' Inserido com Sucesso!!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reg = Produto::find($id);

        return view('produtos_form', ['reg' => $reg, 'acao' => 2]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reg = Produto::find($id);

        return view('produtos_form', ['reg' => $reg, 'acao' => 3]);
    }

    /**
     * Update  $reg = Produto::find($id);the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //posiciona o registro a ser alterado
        $reg = Produto::find($id);

        //obtem todos os campos do formulário
        $dados = $request -> all();

        //Solicita a alteração do registro
        $prod = $reg->update($dados);

        if ($prod) {
            return redirect()->route('produtos.index')->with('status', 'Produto ' . $request->nome . ' Alterado com Sucesso!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = Produto::find($id);
        
        if($reg->delete()){
            return redirect()->route('produtos.index')->with('status', 'Produto ' . $reg->nome . ' Excluir com Sucesso!!');
        }
    }

    public function pesq(Request $request){
        $dados = Produto::where('nome', 'like', '%' .$request->palavra. '%')
                        ->orwhere('marca', 'like', '%' .$request->palavra. '%')->get();
        return view('produtos_lista', ['produtos' => $dados]);
    }
}
