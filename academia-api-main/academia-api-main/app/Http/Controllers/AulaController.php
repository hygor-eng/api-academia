<?php
namespace App\Http\Controllers;

use App\Models\Aula;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(Aula::with('instrutor', 'matricula.aluno')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'matricula_id' => 'required|exists:matriculas,id',
            'instrutor_id' => 'required|exists:instrutores,id',
            'nome'         => 'required|string|max:255',
            'horario'      => 'required|date_format:Y-m-d H:i:s',
            'vagas'        => 'required|integer|min:1',
        ]);

        $aula = Aula::create($data);
        return $this->success($aula->load('instrutor', 'matricula.aluno'), 'Aula criada com sucesso', 201);
    }

    public function show(Aula $aula)
    {
        return $this->success($aula->load('instrutor', 'matricula.aluno'));
    }

    public function update(Request $request, Aula $aula)
    {
        $data = $request->validate([
            'matricula_id' => 'sometimes|exists:matriculas,id',
            'instrutor_id' => 'sometimes|exists:instrutores,id',
            'nome'         => 'sometimes|string|max:255',
            'horario'      => 'sometimes|date_format:Y-m-d H:i:s',
            'vagas'        => 'sometimes|integer|min:1',
        ]);

        $aula->update($data);
        return $this->success($aula->load('instrutor', 'matricula.aluno'), 'Aula atualizada com sucesso');
    }

    public function destroy(Aula $aula)
    {
        $aula->delete();
        return $this->success(null, 'Aula removida com sucesso');
    }
}
