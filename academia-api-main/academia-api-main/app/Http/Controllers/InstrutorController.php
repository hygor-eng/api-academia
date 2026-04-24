<?php
namespace App\Http\Controllers;

use App\Models\Instrutor;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class InstrutorController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(Instrutor::with('user')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'       => 'required|exists:users,id|unique:instrutores,user_id',
            'especialidade' => 'required|string|max:255',
        ]);

        $instrutor = Instrutor::create($data);
        return $this->success($instrutor->load('user'), 'Instrutor criado com sucesso', 201);
    }

    public function show(Instrutor $instrutor)
    {
        return $this->success($instrutor->load('user', 'aulas.matricula.aluno.user'));
    }

    public function update(Request $request, Instrutor $instrutor)
    {
        $data = $request->validate([
            'especialidade' => 'sometimes|string|max:255',
        ]);

        $instrutor->update($data);
        return $this->success($instrutor->load('user'), 'Instrutor atualizado com sucesso');
    }

    public function destroy(Instrutor $instrutor)
    {
        $instrutor->delete();
        return $this->success(null, 'Instrutor removido com sucesso');
    }
}
