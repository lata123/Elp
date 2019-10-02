<?php

namespace App\Module\Model;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';
    protected $fillable = [
        'title',
        'message',
        'status'
    ];
}
