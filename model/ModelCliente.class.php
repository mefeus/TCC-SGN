<?php

/**
 * Ativar a segurança do sistema
 */
new Secure();

/**
 * Criado em 01/01/2015
 * Classe de CRUD com PDO para manter cliente
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ModelCliente extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id;
    private $nome;
    private $cpf;
    private $dtNascimento;
    private $telefone;

    /**
     * Métodos get e sets das classes
     */
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getDtNascimento() {
        return $this->dtNascimento;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setDtNascimento($dtNascimento) {
        $this->dtNascimento = $dtNascimento;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    /**
     * Método mágico para não permitir clonar a classe
     */
    public function __clone() {
        ;
    }

    /**
     * Método utilizado para consultar os clientes cadastrados
     * @access public 
     * @param Int $id id do cliente
     * @param String $nome nome do cliente
     * @return Array dados do cliente
     */
    public function consultarCliente($id_cliente, $nome) {

        #setar os valores
        $this->setId($id_cliente);
        $this->setNome($nome);

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_cliente where true";

        #verificar se foi passado algum valor de $id_cliente    
        if ($this->getId() != null) {
            $sql.= " and id=:id_cliente";
        }

        #verificar se foi passado algum valor de $nome 
        if ($this->getNome() != null) {
            $sql.= " and nome LIKE :nome ";
        }

        #executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de $id_cliente   
            if ($this->getId() != null) {
                $query->bindValue(':id_cliente', $this->getId(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $nome 
            if ($this->getNome() != null) {
                $this->setNome("%" . $nome . "%");
                $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            }
            $query->execute();

            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }

    /**
     * Método utilizado para inserir um cliente
     * @access public 
     * @param String $nome nome do cliente
     * @param String $cpf CPF do cliente
     * @param String $dtNascimento data de nascimento do cliente
     * @param String $telefone telefone do cliente
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirCliente($nome, $cpf, $dtNascimento, $telefone) {

        #setar os dados
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setDtNascimento($dtNascimento);
        $this->setTelefone($telefone);
        echo $this->getTelefone();

        #montar a consulta
        $sql = "INSERT INTO tb_cliente (id,nome, cpf, dtNascimento, telefone) "
                . "VALUES (null,:nome,:cpf,:dtNascimento,:telefone)";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':dtNascimento', $this->getDtNascimento(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para alterar um cliente
     * @access public 
     * @param Int $id id do cliente
     * @param String $nome nome do cliente
     * @param String $cpf CPF do cliente
     * @param String $dtNascimento data de nascimento do cliente
     * @param String $telefone telefone do cliente
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarCliente($id_cliente, $nome, $cpf, $dtNascimento, $telefone) {

        #setar os dados
        $this->setId($id_cliente);
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setDtNascimento($dtNascimento);
        $this->setTelefone($telefone);

        #montar a consulta
        $sql = "UPDATE tb_cliente SET nome = :nome, cpf = :cpf, dtNascimento = :dtNascimento , telefone =:telefone WHERE id = :id_cliente";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_cliente', $this->getId(), PDO::PARAM_INT);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':dtNascimento', $this->getDtNascimento(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para excluir um cliente cadastrado
     * @access public 
     * @param Int $id id do cliente
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    public function excluirCliente($id_cliente) {

        #setar os dados
        $this->setId($id_cliente);

        #montar a consulta
        $sql = "DELETE FROM tb_cliente WHERE id=:id_cliente";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_cliente', $this->getId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    }

}
