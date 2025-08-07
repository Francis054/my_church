<?php

namespace App\Repositories;

use App\Interfaces\DuesInterface;
use App\Models\Dues;
use Illuminate\Database\Eloquent\Collection;

class DuesRepository implements DuesInterface
{
    private Dues $dues;
    /**
     * Create a new class instance.
     */
    public function __construct(Dues $dues)
    {
        $this->dues = $dues;
    }


    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->dues->orderBy('id', 'desc')->get();
    }

    public function find($id): Dues
    {
        return $this->dues->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Dues
    {
        $dues = $this->dues->create($data);
        return $dues;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): Dues
    {
        $dues = $this->find($id);
        $dues->update($data);
        return $dues;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): Dues
    {
        $dues = $this->find($id);
        $dues->delete();
        return $dues;
    }
}
