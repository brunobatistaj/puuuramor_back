<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimalModel extends Model
{
    protected $table = 'animais';
    protected $allowedFields = ['nome', 'descricao', 'imagem'];
}
