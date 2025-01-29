<?php

namespace App\Domain\Branches;

interface BranchRepository
{
    public function create(Branch $branch): void;

    public function update(Branch $branch): void;

    public function delete(string $branch_id): void;

    public function findById(string $branch_id): ?Branch;
}
