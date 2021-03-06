<?php

namespace App\Repositories\Models;

use Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'zip',
        'city',
        'state',
        'neighborhood',
        'address',
        'number',
        'complement'
    ];

    /**
     * @return ContactFactory
     */
    protected static function newFactory()
    {
        return ContactFactory::new();
    }
}
