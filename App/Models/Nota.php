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

    public function nota()
    {
        if (session()->get('mostrar')) {
            return $this->nota;
        }

        return str_repeat('*', strlen($this->nota));
    }

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

    public static function update($id, $titulo, $nota)
    {
        $database = new Database(config('database'));

        $set = "titulo = :titulo";

        if ($nota) {
            $set .= ", nota = :nota";
        }

        $database->query(
            query: "update notas set $set where id = :id",
            params: array_merge([
                ':titulo' => $titulo,
                ':id' => $id
            ], $nota ? [':nota' => $nota] : [])
        );
    }

    public
    static function delete($id)
    {
        $database = new Database(config('database'));

        $database->query(
            query: 'delete from notas where id = :id',
            params: [
                ':id' => $id
            ]
        );
    }
}