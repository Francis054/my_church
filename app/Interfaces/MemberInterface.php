<?php

namespace App\Interfaces;

use App\Models\Member;
use Illuminate\Database\Eloquent\Collection;

interface MemberInterface
{
       /**
     * The function get all Members
     */
    public function all(): Collection;

    /**
     * The function find a single Member
     * @param int $id
     */
    public function find($id): Member;

    /**
     * The function to save Member
     * @param array $request
     */
    public function create(array $data): Member;

    /**
     * The function updates records
     * @param int $id
     * @param array $request
     */
    public function update(int $id, array $data): Member;

    /**
     * The function delete a record
     * @param int $id
     */
    public function delete(int $id): Member;
}
