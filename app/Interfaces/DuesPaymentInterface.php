<?php

namespace App\Interfaces;

use App\Models\DuesPayment;
use Illuminate\Database\Eloquent\Collection;

interface DuesPaymentInterface
{
       /**
     * The function get all Payments
     */
    public function all(): Collection;

    /**
     * The function find a single Payment
     * @param int $id
     */
    public function find($id): DuesPayment;

    /**
     * The function to save Payment
     * @param array $request
     */
    public function create(array $data): DuesPayment;

    /**
     * The function updates records
     * @param int $id
     * @param array $request
     */
    public function update(int $id, array $data): DuesPayment;

    /**
     * The function delete a record
     * @param int $id
     */
    public function delete(int $id): DuesPayment;
}
