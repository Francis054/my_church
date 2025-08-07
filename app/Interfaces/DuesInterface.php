<?php

namespace App\Interfaces;

use App\Models\Dues;
use Illuminate\Database\Eloquent\Collection;

interface DuesInterface
{
      /**
     * The function get all Dues
     */
    public function all(): Collection;

    /**
     * The function find a single Dues
     * @param int $id
     */
    public function find($id): Dues;

    /**
     * The function to save Dues
     * @param array $request
     */
    public function create(array $data): Dues;

    /**
     * The function updates records
     * @param int $id
     * @param array $request
     */
    public function update(int $id, array $data): Dues;

    /**
     * The function delete a record
     * @param int $id
     */
    public function delete(int $id): Dues;
}
