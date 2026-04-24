<?php
namespace App\Http\Controllers;

use App\Models\Plano;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PlanoController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(Plano::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'         => 'required|string|max:255',
            'preco'        => 'required|numeric|min:0',
            'duracao_dias' => 'required|integer|min:1',
        ]);

        $plano = Plano::create($data);
        return $this->success($plano, 'Plano criado com sucesso', 201);
    }

    public function show(Plano $plano)
    {
        return $this->success($plano->load('matriculas'));
    }

    public function update(Request $request, Plano $plano)
    {
        $data = $request->validate([
            'nome'         => 'sometimes|string|max:255',
            'preco'        => 'sometimes|numeric|min:0',
            'duracao_dias' => 'sometimes|integer|min:1',
        ]);

        $plano->update($data);
        return $this->success($plano, 'Plano atualizado com sucesso');
    }

    public function destroy(Plano $plano)
    {
        $plano->delete();
        return $this->success(null, 'Plano removido com sucesso');
    }
}
