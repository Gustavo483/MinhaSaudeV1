<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoModel extends Model
{
    use HasFactory;

    protected $table = 'tb_arquivos';

    protected $primaryKey = 'id_arquivo';
    protected $fillable = ['id_arquivo', 'id_exame','fl_arquivo'];

    public function Exame(){
        return $this->belongsTo(ExameModel::class, 'id_exame', 'id_exame');
    }

}
