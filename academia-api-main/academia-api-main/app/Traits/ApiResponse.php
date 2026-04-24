<?php
namespace App\Traits;

trait ApiResponse
{
    protected function success($data, $message = 'Sucesso', $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    protected function error($message = 'Erro', $status = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => null,
        ], $status);
    }
}
