<?php
namespace App\Application\Services;

use Illuminate\Support\Facades\DB;
use App\Domain\Services\LimiteGlobal;
use App\Domain\Entities\LimiteGlobal as LimiteGlobalEntity;
use App\Infra\Repositories\EloquentLimiteRepository;

class LimiteGlobalService
{
    public function atribuirLimitePorEmpresa(array $inputs)
    {
        DB::beginTransaction();
        try {
            $limiteEntity = new LimiteGlobalEntity();
            $limiteEntity->setEmpresa($inputs['cnpj_empresa']);
            $limiteEntity->setLimite($inputs['limite']);
            $limiteRepository = new EloquentLimiteRepository();
            $limiteGlobal = new LimiteGlobal($limiteRepository);
            $novoLimite = $limiteGlobal->incluirLimiteGlobal($limiteEntity);
            $limiteEntity = $this->setLimiteEntity($limiteEntity, $novoLimite);
            DB::commit();
            return $limiteEntity->getDataLimite();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function setLimiteEntity($limiteEntity, $novoLimite){
        $limiteEntity->setEmpresa($novoLimite->cnpj_empresa);
        $limiteEntity->setLimite($novoLimite->limite);
        return $limiteEntity;
    }

}
