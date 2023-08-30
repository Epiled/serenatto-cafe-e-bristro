<?php

class ProdutoRepositorio 
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto($dados)
    {
        return new Produto(
            $dados['id'],
            $dados['tipo'],
            $dados['nome'],
            $dados['descricao'],
            $dados['preco'],
            $dados['imagem'],
        );
    }

    public function opcoesCafe() 
    {
        $sql1 = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $statement = $this->pdo->query($sql1);
        $produtosCafe = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $dadosCafe = array_map(function($cafe){
            return $this->formarObjeto($cafe);
        }, $produtosCafe);
        
        return $dadosCafe;
    }

    public function opcoesAlmoco() 
    {
        $sql2 = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
        $statement = $this->pdo->query($sql2);
        $produtosAlmoco = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $dadosAlmoco = array_map(function($almoco){
            return $this->formarObjeto($almoco);
        }, $produtosAlmoco);

        return $dadosAlmoco;
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM produtos ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $produtos = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dados = array_map(function($produto){
            return $this->formarObjeto($produto);
        }, $produtos);

        return $dados;
    }

    public function buscarProduto(int $id)
    {
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$id);
        $statement->execute();
        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }

    public function deletar(int $id) 
    {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$id);
        $statement->execute();
    }

    public function salvar(Produto $produto)
    {
        $sql = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES(?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$produto->getTipo());
        $statement->bindValue(2,$produto->getNome());
        $statement->bindValue(3,$produto->getDescricao());
        $statement->bindValue(4,$produto->getPreco());
        $statement->bindValue(5,$produto->getId());
        $statement->execute();

        if($produto->getImagem() !== 'logo-serenatto.png') {
            $this->atualizarFoto($produto);
        }
    }

    public function atualizarFoto(Produto $produto) 
    {
        $sql = "UPDATE produtos SET imagem = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$produto->getImagem());
        $statement->bindValue(2,$produto->getId());
        $statement->execute();
    }

    public function atualizar(Produto $produto) 
    {
        $sql = "UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$produto->getTipo());
        $statement->bindValue(2,$produto->getNome());
        $statement->bindValue(3,$produto->getDescricao());
        $statement->bindValue(4,$produto->getPreco());
        $statement->bindValue(5,$produto->getImagem());
        $statement->bindValue(6,$produto->getId());
        $statement->execute();
    }
}