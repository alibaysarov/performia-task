<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TodoModel extends Model
{
    use HasFactory;
    protected $table ='todos';
    protected $primaryKey = 'id';
    protected $fillable=[
        'title',
        'user_id',
    ];
    public $timestamps = true;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
