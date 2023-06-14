<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
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
     * @param StoreUpdateSupport $request
     * @param Support $support
     * @return void
     */
    public function store(StoreUpdateSupport $request, Support $support)
    {
        $data = $request->validated();
        $data['status'] = 'a';

        $support = $support->create($data);

        return redirect()->route('supports.index');
    }

    /**
     * Exibe o formulário editar dúvida
     *
     * @param Support $support
     * @param string|integer $id
     * @return void
     */
    public function edit(Support $support, string|int $id)
    {
        if (!$support = $support->where('id', $id)->first()) {
            return back();
        }

        return view('admin.supports.edit', compact('support'));
    }

    /**
     * Edita os dados no banco de dadosUndocumented function
     *
     * @param StoreUpdateSupport $request
     * @param Support $support
     * @param string|integer $id
     * @return void
     */
    public function update (StoreUpdateSupport $request, Support $support, string|int $id)
    {
        if (!$support = $support->find($id)) {
            return back();
        }

        $support->update($request->validated());

        return redirect()->route('supports.index');
    }

    /**
     * Delete o registro no banco de dados
     *
     * @param string|integer $id
     * @return void
     */
    public function destroy(string|int $id)
    {
        if (!$support = Support::find($id)) {
            return back();
        }

        $support->delete();

        return redirect()->route('supports.index');
    }
}
