<?php

namespace App\Models;

use Carbon\Carbon;
use Core\Database;

class Nota
{
    public $id;

    public $usuario_id;

    public $titulo;

    public $nota;

    public $data_criacao;

    public $data_atualizacao;

    public function dataCriacao()
    {
        return Carbon::parse($this->data_criacao);
    }

    public function dataAtualizacao() 
    {
        return Carbon::parse($this->data_atualizacao);
    }

    public function nota()
    {
        if (session()->get('mostrar')) {
            return secured_decrypt($this->nota);
        }

        return str_repeat('*', rand(10, 100));
    }

    public static function create(array $data)
    {
        $database = new Database(config('database'));

        $database->query(
            query: '
            insert into notas (usuario_id, titulo, nota, data_criacao, data_atualizacao) 
            values (:usuario_id, :titulo, :nota, :data_criacao, :data_atualizacao)
            ',
            params: array_merge($data, [
                ':data_criacao' => date('Y-m-d H:i:s'),
                ':data_atualizacao' => date('Y-m-d H:i:s'),
            ])
        );
    }

    public static function all($filter)
    {
        $database = new Database(config('database'));

        return $database->query(
            query: 'select * from notas where usuario_id = :usuario_id '.(
                $filter ? 'and titulo like :filter' : null
            ),
            class: self::class,
            params: array_merge([':usuario_id' => auth()->id], $filter ? [':filter' => "%$filter%"] : [])
        )->fetchAll();
    }

    public static function update($id, $titulo, $nota)
    {
        $database = new Database(config('database'));

        $set = 'titulo = :titulo';

        if ($nota) {
            $set .= ', nota = :nota';
        }

        $database->query(
            query: "update notas set $set where id = :id",
            params: array_merge([
                ':titulo' => $titulo,
                ':id' => $id,
            ], $nota ? [':nota' => secured_encrypt($nota)] : [])
        );
    }

    public static function delete($id)
    {
        $database = new Database(config('database'));

        $database->query(
            query: 'delete from notas where id = :id',
            params: [
                ':id' => $id,
            ]
        );
    }
}
