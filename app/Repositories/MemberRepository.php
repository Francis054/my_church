<?php

namespace App\Repositories;

use App\Interfaces\MemberInterface;
use App\Models\Member;
use Illuminate\Database\Eloquent\Collection;

class MemberRepository implements MemberInterface
{
   private Member $member;
    /**
     * Create a new class instance.
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }


    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->member->orderBy('id', 'desc')->get();
    }

    public function find($id): Member
    {
        return $this->member->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Member
    {
        $member = $this->member->create($data);
        return $member;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): Member
    {
        $member = $this->find($id);
        $member->update($data);
        return $member;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): Member
    {
        $member = $this->find($id);
        $member->delete();
        return $member;
    }
}

