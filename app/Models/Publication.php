<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Publication
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 */
class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body'
    ];
}
