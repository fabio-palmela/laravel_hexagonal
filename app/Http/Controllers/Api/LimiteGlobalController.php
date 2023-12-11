<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Application\Services\LimiteGlobalService;

class LimiteGlobalController extends Controller
{
    private $limiteGlobalService;

    public function __construct(LimiteGlobalService $limiteGlobalService)
    {
        $this->limiteGlobalService = $limiteGlobalService;
    }

    public function atribuirLimite(Request $request)
    {
        try {
            $dados = $request->validate([
                'cnpj_empresa' => 'required|string',
                'limite' => 'required|numeric',
            ]);

            $novoLimite = $this->limiteGlobalService->atribuirLimitePorEmpresa($dados);
            return response()->json(['content' => $novoLimite], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erro ao atribuir limite. Detalhes: ' . $th->getMessage()], 500);
        }
    }
}
