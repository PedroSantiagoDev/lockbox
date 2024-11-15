<?php

namespace App\Models;

use Core\Database;

class Nota
{
    public $id;
    public $usuario_id;
    public $titulo;
    public $nota;
    public $data_criacao;
    public $data_atualizacao;

    public static function all($filter)
    {
        $database = new Database(config('database'));

        return $database->query(
            query: "select * from notas where usuario_id = :usuario_id " . (
                 $filter ? "and titulo like :filter" : null
            ),
            class: self::class,
            params: array_merge([':usuario_id' => auth()->id], $filter ? [':filter' => "%$filter%"] : [])
        )->fetchAll();
    }
}