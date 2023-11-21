<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaExameModel extends Model
{
    use HasFactory;

    protected $table = 'tb_nota_exame';
    protected $primaryKey = 'id_notaExame';

    protected $fillable = ['st_nomeNota','st_descricao','id_exame'];

    public function Exame(){
        return $this->belongsTo(ExameModel::class, 'id_exame', 'id_exame');
    }
}
