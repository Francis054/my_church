<?php

namespace App\Interfaces;

use App\Models\Tithe;
use Illuminate\Database\Eloquent\Collection;

interface TitheInterface
{
    
       /**
     * The function get all Tithes
     */
    public function all(): Collection;

    /**
     * The function find a single Tithe
     * @param int $id
     */
    public function find($id): Tithe;

    /**
     * The function to save Tithe
     * @param array $request
     */
    public function create(array $data): Tithe;

    /**
     * The function updates records
     * @param int $id
     * @param array $request
     */
    public function update(int $id, array $data): Tithe;

    /**
     * The function delete a record
     * @param int $id
     */
    public function delete(int $id): Tithe;

    /**
     * The function get member assigned to a tithe
     * @param int $member_id
     *
     */

}

