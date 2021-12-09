<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $table = 'missions';
    protected $fillable = [
        'capsule_id',
        'capsule_serial',
        'name',
        'flight'
    ];

    public function capsuleMissions(){
        return $this->belongsTo(Capsule::class);
    }
}
