<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historial extends Model
{
    use HasFactory;
    protected $table = 'historials';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fechaHoraSalida',
        'fechaHoraEntrada',
        'user_id',
        'enabled'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
