<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewedMessage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'chat_id',
        'message_id',
        'read_at',
    ];
    protected $appends = ['countNotViewed'];

    public function getCountNotViewedAttribute()
    {
        return Message::where('chat_id', $this->chat_id)
            ->where('id', '>', $this->message_id ?? 0)
            ->count();
    }
}
