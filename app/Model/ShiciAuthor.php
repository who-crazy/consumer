<?php

declare (strict_types=1);
namespace App\Model;

/**
 */
class ShiciAuthor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shici_author';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}