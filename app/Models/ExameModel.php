<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExameModel extends Model
{
    use HasFactory;

    protected $table = 'tb_exames';

    protected $primaryKey = 'id_exame';

    protected $fillable = ['st_especialidade','id_user','st_descricao','st_nome_medico','st_localizacao','dt_data'];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function arquivo(){
        return $this->hasMany(ArquivoModel::class, 'id_exame', 'id_exame');
    }

}
