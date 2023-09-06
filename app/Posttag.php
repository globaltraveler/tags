<?php
namespace App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Posttag extends Model
{
    public $table = 'posttags';
    use HasFactory;
    use \Conner\Tagging\Taggable;
    
    protected $fillable = [ 
        'id',
        'title_name', 
        'content' 
    ];
}