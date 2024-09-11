<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MessageModel extends Model
{
    use HasFactory;

    protected $table = 'm_messages';
    protected $fillable = ['message', 'sender_id', 'group_id', 'receiver_id'];
    protected $keyType = 'string';
    public $incrementing = false;
}
