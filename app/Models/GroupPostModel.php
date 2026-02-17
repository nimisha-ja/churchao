<?php

namespace App\Models;
use CodeIgniter\Model;

class GroupPostModel extends Model
{
    protected $table = 'group_posts';
    protected $primaryKey = 'post_id';
    protected $allowedFields = ['group_id', 'member_id', 'content', 'created_on'];
}
