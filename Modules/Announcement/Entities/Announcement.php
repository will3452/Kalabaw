<?php

namespace Modules\Announcement\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'for',
    ];
    const _COLUMNS = [
        'message',
        'user_id',
        'for',
    ];

    const _TYPE = [
        'message' => 'textarea',
    ];

    const _SELECT = [
        'for',
    ];

    const _OPTIONS = [
        'for' => [
            'all' => 'all',
            'farmers' => 'farmers',
            'fishermen' => 'fishermen',
        ],
    ];

    const _CHECKBOX = [];


    public function title()
    {
        return $this->user->title();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRelation($rel)
    {
        if ($rel == 'user') {
            return $this->user;
        }
    }


    const _EXCLUDE_TO_FORM = [
        'user_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Announcement\Database\factories\AnnouncementFactory::new();
    }

    public static function boot () {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }
}
