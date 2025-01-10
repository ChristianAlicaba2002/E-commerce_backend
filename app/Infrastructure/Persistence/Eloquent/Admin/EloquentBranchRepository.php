<?php

namespace App\Infrastructure\Persistence\Eloquent\Admin;

use App\Domain\Branches\Branch;
use App\Domain\Branches\BranchRepository;

class EloquentBranchRepository implements BranchRepository
{
    public function create(Branch $branch): void
    {
        $BranchesModel = BranchesModel::find($branch->getBranchId()) ?? new BranchesModel;
        $BranchesModel->branch_id = $branch->getBranchId();
        $BranchesModel->branch_name = $branch->getBranchName();
        $BranchesModel->first_name = $branch->getFirstName();
        $BranchesModel->last_name = $branch->getLastName();
        $BranchesModel->address = $branch->getAddress();
        $BranchesModel->phone_number = $branch->getPhoneNumber();
        $BranchesModel->email = $branch->getEmail();
        $BranchesModel->password = $branch->getPassword();
        $BranchesModel->status = $branch->getStatus();
        $BranchesModel->save();
    }

    public function update(Branch $branch): void
    {
        $BranchesModel = BranchesModel::find($branch->getBranchId()) ?? new BranchesModel;
        $BranchesModel->branch_id = $branch->getBranchId();
        $BranchesModel->branch_name = $branch->getBranchName();
        $BranchesModel->first_name = $branch->getFirstName();
        $BranchesModel->last_name = $branch->getLastName();
        $BranchesModel->address = $branch->getAddress();
        $BranchesModel->phone_number = $branch->getPhoneNumber();
        $BranchesModel->email = $branch->getEmail();
        $BranchesModel->password = $branch->getPassword();
        $BranchesModel->status = $branch->getStatus();
        $BranchesModel->save();
    }

    public function findByBranchID(string $branch_id): ?Branch
    {
        $branchModel = BranchesModel::where('branch_id', $branch_id)->first();
        
        if (!$branchModel) {
            return null;
        }

        return new Branch(
            $branchModel->branch_id,
            $branchModel->branch_name,
            $branchModel->first_name,
            $branchModel->last_name,
            $branchModel->address,
            $branchModel->phone_number,
            $branchModel->email,
            $branchModel->password,
            $branchModel->status,
            $branchModel->created_at,
            $branchModel->updated_at
        );
    }

    // public function delete(Branch $branch): void
    // {
    //     $BranchesModel = BranchesModel::find($branch->getBranch_id()) ?? new BranchesModel;
    //     $BranchesModel->delete();
    // }
}
