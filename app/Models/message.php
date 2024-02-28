<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
class message extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_incoming_id',
        'user_outgoing_id',
        'message',
    ];
    function user_sent_message_id()
    {
       return $this->belongsTo($User::class,'user_sent_message_id');
    }
    function user_recieve_message_id()
    {
       return $this->belongsTo($User::class,'user_recieve_message_id');
    }
}
