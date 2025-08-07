<?php

namespace App\Interfaces;

use App\Models\Church;
use Illuminate\Database\Eloquent\Collection;

interface ChurchInterface
{
     /**
     * The function get all Church
     */
    public function all(): Collection;

    /**
     * The function find a single Church
     * @param int $id
     */
    public function find($id): Church;

    /**
     * The function to save Church
     * @param array $request
     */
    public function create(array $data): Church;

    /**
     * The function updates records
     * @param int $id
     * @param array $request
     */
    public function update(int $id, array $data): Church;

    /**
     * The function delete a record
     * @param int $id
     */
    public function delete(int $id): Church;
}
