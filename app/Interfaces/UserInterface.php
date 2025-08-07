<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserInterface
{
     /**
     * The function get all User
     */
    public function all(): Collection;

    /**
     * The function find a single User
     * @param int $id
     */
    public function find($id): User;

    /**
     * The function to save User
     * @param array $request
     */
    public function create(array $data): User;

    /**
     * The function updates records
     * @param int $id
     * @param array $request
     */
    public function update(int $id, array $data): User;

    /**
     * The function delete a record
     * @param int $id
     */
    public function delete(int $id): User;
}
