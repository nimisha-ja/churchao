<?php


namespace App\Models;

use CodeIgniter\Model;

class GroupMemberModel extends Model
{
    protected $table = 'group_members';
    protected $allowedFields = [
        'group_id',
        'member_id',
        'joined_on'
    ];
}
