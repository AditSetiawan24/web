<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamModel extends Model
{
    protected $table = 'tb_team';
    protected $primaryKey = 'id_member';
    protected $allowedFields = ['nama', 'posisi', 'photo_url', 'fb', 'x', 'ig'];
    protected $useTimestamps = false;
}