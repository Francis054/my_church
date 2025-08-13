<?php

namespace App\Repositories;

use App\Interfaces\DuesPaymentInterface;
use App\Models\DuesPayment;
use Illuminate\Database\Eloquent\Collection;

class DuesPaymentRepository implements DuesPaymentInterface
{
    private DuesPayment $dues_payment;
    /**
     * Create a new class instance.
     */
    public function __construct(DuesPayment $dues_payment)
    {
        $this->dues_payment = $dues_payment;
    }


    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->dues_payment->orderBy('id', 'desc')->get();
    }

    public function find($id): DuesPayment
    {
        return $this->dues_payment->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): DuesPayment
    {
        $dues_payment = $this->dues_payment->create($data);
        return $dues_payment;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): DuesPayment
    {
        $dues_payment = $this->find($id);
        $dues_payment->update($data);
        return $dues_payment;
   }

    /**
     * @inheritDoc
     */
    public function delete(int $id): DuesPayment
    {
        $dues_payment = $this->find($id);
        $dues_payment->delete();
        return $dues_payment;
    }
}
