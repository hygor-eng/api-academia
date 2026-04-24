<?php
namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MatriculaController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(Matricula::with('aluno', 'plano')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'aluno_id'    => 'required|exists:alunos,id',
            'plano_id'    => 'required|exists:planos,id',
            'data_inicio' => 'required|date',
            'data_fim'    => 'required|date|after:data_inicio',
            'status'      => 'sometimes|in:ativa,inativa,suspensa',
        ]);

        $matricula = Matricula::create($data);
        return $this->success($matricula->load('aluno', 'plano'), 'Matrícula criada com sucesso', 201);
    }

    public function show(Matricula $matricula)
    {
        return $this->success($matricula->load('aluno', 'plano', 'aulas.instrutor'));
    }

    public function update(Request $request, Matricula $matricula)
    {
        // data_inicio de referência: o que vier no request ou o valor já salvo
        $dataInicio = $request->input('data_inicio', $matricula->data_inicio);

        $data = $request->validate([
            'plano_id'    => 'sometimes|exists:planos,id',
            'data_inicio' => 'sometimes|date',
            'data_fim'    => 'sometimes|date|after:' . $dataInicio,
            'status'      => 'sometimes|in:ativa,inativa,suspensa',
        ]);

        $matricula->update($data);
        return $this->success($matricula, 'Matrícula atualizada com sucesso');
    }

    public function destroy(Matricula $matricula)
    {
        $matricula->delete();
        return $this->success(null, 'Matrícula removida com sucesso');
    }
}
