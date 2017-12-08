<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageManagement extends Model
{
    use SoftDeletes;

    protected $table = 'message_managements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message_id', 'from_user_id', 'to_user_id', 'read_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /** ---------------------- read status -------------------------*/

    const READ_STATUS_IS_TRUE = 1;
    const READ_STATUS_IS_FALSE = 0;

    public static $READ_STATUSES = [
        self::READ_STATUS_IS_FALSE,
        self::READ_STATUS_IS_TRUE,
    ];

    public function switchStatus()
    {
        return !$this->read_status;
    }

    /** ---------------------- Relation -------------------------*/

    public function message()
    {
        $this->belongsTo(Message::class, 'message_id');
    }

    public function fromUser()
    {
        $this->belongsTo(User::class, 'from_user_id');
    }
}
