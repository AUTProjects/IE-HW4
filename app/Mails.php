<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string attachment
 * @property  string from
 * @property string to
 * @property string title
 * @property string type
 * @property string text
 */
class Mails extends Model
{
    protected $fillable = [
        'to','from', 'read',
    ];

}
