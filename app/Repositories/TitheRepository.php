<?php

namespace App\Repositories;

use App\Interfaces\TitheInterface;
use App\Models\Tithe;
use Illuminate\Database\Eloquent\Collection;

class TitheRepository implements TitheInterface
{
     private Tithe $tithe;
    /**
     * Create a new class instance.
     */
    public function __construct(Tithe $tithe)
    {
        $this->tithe = $tithe;
    }


    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->tithe->orderBy('id', 'desc')->get();
    }

    public function find($id): Tithe
    {
        return $this->tithe->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Tithe
    {
        $tithe = $this->tithe->create($data);
        return $tithe;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): Tithe
    {
        $tithe = $this->find($id);
        $tithe->update($data);
        return $tithe;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): Tithe
    {
        $tithe = $this->find($id);
        $tithe->delete();
        return $tithe;
    }

 
}