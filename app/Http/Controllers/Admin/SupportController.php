<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{ 
    /**
     * Service layer
     *
     * @param SupportService $service
     */
    public function __construct(
        protected SupportService $service
    ) {}

    /**
     * Página inicial
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter,
        );

        return view('admin.supports.index', compact('supports'));
    }

    /**
     * Exibe a página detalhes do suporte
     *
     * @param string $id
     * @return void
     */
    public function show(string $id)
    {
        // Support::find($id);
        // Support::where('id', $id)->first();
        // Support::where('id', '!=', $id)->first();
        if (!$support = $this->service->findOne($id)) {
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
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return redirect()->route('supports.index');
    }

    /**
     * Exibe o formulário editar dúvida
     *
     * @param string $id
     * @return void
     */
    public function edit(string $id)
    {
        /* if (!$support = $support->where('id', $id)->first()) { */
        if (!$support = $this->service->findOne($id)) {
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
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request)
        );

        if (!$support) {
            return back();
        }

        return redirect()->route('supports.index');
    }

    /**
     * Delete o registro no banco de dados
     *
     * @param string $id
     * @return void
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route('supports.index');
    }
}
