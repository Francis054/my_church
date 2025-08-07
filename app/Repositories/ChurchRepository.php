<?php

namespace App\Repositories;

use App\Interfaces\ChurchInterface;
use App\Models\Church;
use Illuminate\Database\Eloquent\Collection;

class ChurchRepository implements ChurchInterface
{
    private Church $church;
    /**
     * Create a new class instance.
     */
    public function __construct(Church $church)
    {
        $this->church = $church;
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->church->orderBy('id', 'desc')->get();
    }

    public function find($id): Church
    {
        return $this->church->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Church
    {
        $church = $this->church->create($data);
        return $church;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): Church
    {
        $church = $this->find($id);
        $church->update($data);
        return $church;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): Church
    {
        $church = $this->find($id);
        $church->delete();
        return $church;
    }
}
