<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'ni',
        'role',
        'type',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeDetails($query){
        if ($this->type == 'guru') {
            return DB::table('teacher_details')->where('id', $this->id)->first();
        } else if ($this->type == 'siswa') {
            return DB::table('student_details')->where('id', $this->id)->first();
        } else {
            return DB::table('staff_details')->where('id', $this->id)->first();
        }
    }

    public function posts(){
        return $this->hasMany(Post::class, 'creator_id');
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
