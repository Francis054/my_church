<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserInterface
{
    private User $user;
    /**
     * Create a new class instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->user->orderBy('id', 'desc')->get();
    }

    /**
     * @inheritDoc
     */
    public function find($id): User
    {
        return $this->user->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): User
    {
        $user = $this->user->create($data);
        return $user;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): User
    {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): User
    {
        $user = $this->find($id);
        $user->delete();
        return $user;
    }
}
