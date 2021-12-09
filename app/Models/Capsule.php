<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Capsule extends Model
{
    use HasFactory;
    
    protected $table = 'capsules';
    protected $fillable = [
        'capsule_serial',
        'capsule_id',
        'status',
        'original_launch',
        'original_launch_unix',
        'landings',
        'type',
        'details',
        'reuse_count'
    ];

    public function missions(){
        return $this->hasMany(Mission::class, 'capsule_id');
    }
}
