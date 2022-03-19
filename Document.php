<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'document_details';
    protected $fillable =['id', 'name', 'url', 'created_at', 'createdby', 'updated_at', 'updatedby'];
}
