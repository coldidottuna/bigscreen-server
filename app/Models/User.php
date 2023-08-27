<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'id',
        'email',
        'password', // seulement si Admin
        'token', // Ajout de la nouvelle colonne "token"
        'is_admin'
    ];


    protected $hidden = [
        'password' ,
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',

    ];


    // Générer un token unique pour chaque nouvel utilisateur non administrateur 
    // token qui va etre utilisé dans l'url pour la recupération des reponses
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
        if (!$user->is_admin) {
            $user->token = Str::uuid();
        }
    });
    }


    // relation entre les tables user et answer pour associer des reponses a un même utilisateurs
    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
