<?php
namespace App\Domain\Entities;

class LimiteGlobal
{
    private $id;
    private $limite;
    private $cnpjEmpresa;

    public function getId(){
        return $this->id;
    }

    public function getEmpresa(){
        return $this->cnpjEmpresa;
    }

    public function getLimite(){
        return $this->limite;
    }
    
    public function setEmpresa($cnpj){
        $this->cnpjEmpresa = $cnpj;
    }

    public function setLimite($limite){
        $this->limite = $limite;
    }
    
    public function getDataLimite(){
        return [
            'cnpj_empresa' => $this->cnpjEmpresa,
            'novo_limite' => $this->limite,
        ];
    }
}
