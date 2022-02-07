<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','content','slug','category_id'];
    public static function generateSlug($title){
        //genero lo slag
        $slug = Str::slug($title);
        $slug_base = $slug;
        //verifico se è presente nel db
        //SELECT * FROM posts WHERE slug = $slug->first restituisce solo il primo risultato in un oggetto
        $post_presente = Post::where('slug',$slug)->first();
        //se è presente concateno allo slug un contatore
        $counter=1;
        while($post_presente){
            $slug= $slug_base.'-'.$counter;
            $counter++;
            $post_presente = Post::where('slug',$slug)->first();
        }
        return $slug;
    }
    public function category(){
        return $this->belongsTo('App\Category');
         
    }
    public function tags(){
       return $this->belongsToMany('App\Tag');
    }
}
