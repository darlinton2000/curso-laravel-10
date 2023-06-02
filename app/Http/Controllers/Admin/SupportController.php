<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{ 
    /**
     * Página inicial
     *
     * @param Support $support
     * @return void
     */
    public function index(Support $support)
    {
        $supports = $support->all();

        return view('admin.supports.index', compact('supports'));
    }

    /**
     * Exibe a página detalhes do suporte
     *
     * @param string|integer $id
     * @return void
     */
    public function show(string|int $id)
    {
        // Support::find($id);
        // Support::where('id', $id)->first();
        // Support::where('id', '!=', $id)->first();
        if (!$support = Support::find($id)) {
            return back();
        }

        return view('admin.supports.show', compact('support'));
    }

    /**
     * Exibe o formulário nova dúvida
     *
     * @return void
     */
    public function create()
    {
        return view('admin.supports.create');
    }

    /**
     * Cadastra os dados do formulário nova dúvida
     *
     * @param Request $request
     * @param Support $support
     * @return void
     */
    public function store(Request $request, Support $support)
    {
        $data = $request->all();
        $data['status'] = 'a';

        $support = $support->create($data);

        return redirect()->route('supports.index');
    }
}
