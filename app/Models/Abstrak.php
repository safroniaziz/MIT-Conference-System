<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abstrak extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul','abstrak','file_abstrak','status','tahun_usulan','user_id','proof_of_payment'
    ];

    public function getShortAbstrakAttribute(){
        return substr($this->abstrak, 0, random_int(180,200)). '...';
    }

    public function getShortJudulAttribute(){
        return substr($this->judul, 0, random_int(80,100)). '...';
    }
}
