<?php

namespace App\Application\Branch;

use App\Domain\Branches\Branch;
use App\Domain\Branches\BranchRepository;

class RegisterBranch
{
    private BranchRepository $branchRepository;

    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    public function create(
        string $branch_id,
        string $branch_name,
        string $first_name,
        string $last_name,
        string $address,
        string $phone_number,
        string $email,
        string $password,
        string $status,
        string $created_at,
        string $updated_at
    ) {
        $AddBranches = new Branch(
            $branch_id,
            $branch_name,
            $first_name,
            $last_name,
            $address,
            $phone_number,
            $email,
            $password,
            $status,
            $created_at,
            $updated_at
        );

        return $this->branchRepository->create($AddBranches);
    }

    public function update(
        string $branch_id,
        string $branch_name,
        string $first_name,
        string $last_name,
        string $address,
        string $phone_number,
        string $email,
        string $password,
        string $status,
        string $created_at,
        string $updated_at
    ) {
        $existingBranch = $this->branchRepository->findById($branch_id);
        if (! $existingBranch) {
            throw new \Exception('Branch not found');
        }

        $UpdateBranches = new Branch(
            $branch_id,
            $branch_name,
            $first_name,
            $last_name,
            $address,
            $phone_number,
            $email,
            $password,
            $status,
            $created_at,
            $updated_at
        );

        return $this->branchRepository->update($UpdateBranches);
    }

    public function delete(string $branch_id)
    {
        return $this->branchRepository->delete($branch_id);
    }


    public function findById(String $branch_id)
    {
        return $this->branchRepository->findById($branch_id);
    }
}
