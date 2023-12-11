<?php
namespace App\Infra\Repositories;

use App\Domain\Entities\LimiteGlobal;
use App\Domain\Repositories\LimiteGlobalRepository;
use App\Infra\Adapters\Eloquent\LimiteGlobalModel;

class EloquentLimiteRepository implements LimiteGlobalRepository
{
    public function salvar(LimiteGlobal $limite)
    {
        $novoLimite = LimiteGlobalModel::updateOrCreate(['id' => $limite->getId()], [
            'cnpj_empresa' => $limite->getEmpresa(),
            'limite' => $limite->getLimite(),
        ]);
        return $novoLimite;
    }

    public function remover($limiteId)
    {
        $limiteModel = LimiteGlobalModel::find($limiteId);
        // dd($limiteModel);
        $limiteModel->delete();  
    }

    public function getLimite($cnpj)
    {
        $limiteModel = LimiteGlobalModel::where('cnpj_empresa', $cnpj);
        return $limiteModel->first();
    }
}
