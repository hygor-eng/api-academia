<?php
namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(Aluno::with('user')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'         => 'required|exists:users,id|unique:alunos,user_id',
            'telefone'        => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
        ]);

        $aluno = Aluno::create($data);
        return $this->success($aluno->load('user'), 'Aluno criado com sucesso', 201);
    }

    public function show(Aluno $aluno)
    {
        return $this->success($aluno->load('user', 'matriculas.plano', 'matriculas.aulas.instrutor.user'));
    }

    public function update(Request $request, Aluno $aluno)
    {
        $data = $request->validate([
            'telefone'        => 'sometimes|nullable|string|max:20',
            'data_nascimento' => 'sometimes|nullable|date',
        ]);

        $aluno->update($data);
        return $this->success($aluno->load('user'), 'Aluno atualizado com sucesso');
    }

    public function destroy(Aluno $aluno)
    {
        $aluno->delete();
        return $this->success(null, 'Aluno removido com sucesso');
    }
}
