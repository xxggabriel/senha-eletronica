<?php 

namespace SenhaEletronica\Controller;

use SenhaEletronica\Model\Sql;

class ApiController
{

    public function proximo()
    {
        $sql = new Sql();
        $senha = $sql->select("SELECT senha FROM senhas  ORDER BY id DESC LIMIT 1")[0]["senha"];
        $senha ++;
        $result = $sql->query("INSERT INTO senhas (senha, guiche, data, status) VALUES (:senha, :guiche, :data, :status);", [
            ":senha" =>     $senha,
            ":guiche" =>    $_POST["guiche"],
            ":data" =>      $_POST["data"],
            ":status" =>    1,
        ]);

        echo json_encode([
            "error" => !$result,
            "senha" => $senha,
            "guiche" => $_POST["guiche"],
            "data" => $_POST["data"],
            "status" => 1
        ]);
    }

    public function removeSenha()
    {
        $sql = new Sql();
        $senha = $sql->select("SELECT senha FROM senhas WHERE senha = :senha", [
            ":senha" => $_POST["senha"]
        ]);

        if(!empty($senha)){
            $result = $sql->query("DELETE FROM senhas WHERE senha = :senha", [
                ":senha" => $_POST["senha"]
            ]);
        }

        echo json_encode([
            "error" => !$result,
            "senha" => $_POST["senha"],
            "status" => 1
        ]);
    }

    public function chamarNovamente($senha)
    {
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM senhas ORDER BY id DESC LIMIT 10");

        if(!empty($result)){
            $sql->query("UPDATE senhas SET status = :status WHERE senha = :senha", [
                ":senha" => $senha,
                ":status" => 1
            ]);
        }
        
        echo $this->getAllSenhas(false);
    }

    public function getAllSenhas($veridicar = true)
    {
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM senhas ORDER BY id DESC LIMIT 10 ");

        if($veridicar){
            foreach ($result as $key) {
                if($key["status"] == 1){
                    $sql->query("UPDATE senhas SET status = :status WHERE id = :id", [
                        ":id" => $key["id"],
                        ":status" => 2
                    ]);
                }
            }
        }
        echo json_encode($result);
    }

}