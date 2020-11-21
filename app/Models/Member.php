<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone_number', 'status', 'foto'];
    protected $appends = ['status_label'];
    
    //membuat fungsi untuk membaca isi dari data status dan mengembalikan dalam bentun tag span
    public function getStatusLabelAttribute(){
        if($this->status == 0){
            return '<span class="text-red-500">Free</span>';
        }else{
            return '<span class="text-teal-500">Premium</span>';
        }
    }
}
