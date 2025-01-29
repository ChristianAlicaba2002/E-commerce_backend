<?php

namespace App\Domain\Branches;


class Branch
{
   public function __construct(
      private ?string $branch_id,
      private ?string $branch_name,
      private ?string $first_name,
      private ?string $last_name,
      private ?string $address,
      private ?string $phone_number,
      private ?string $email,
      private ?string $password,
      private ?string $status,
      private ?string $created_at,
      private ?string $updated_at
   ) {
      $this->branch_id = $branch_id;
      $this->branch_name = $branch_name;
      $this->first_name = $first_name;
      $this->last_name = $last_name;
      $this->address = $address;
      $this->phone_number = $phone_number;
      $this->email = $email;
      $this->password = $password;
      $this->status = $status;
      $this->created_at = $created_at;
      $this->updated_at = $updated_at;
   }


   public function BranchArray(): array
   {
      return [
         'branch_id' => $this->branch_id,
         'branch_name' => $this->branch_name,
         'first_name' => $this->first_name,
         'last_name' => $this->last_name,
         'address' => $this->address,
         'phone_number' => $this->phone_number,
         'email' => $this->email,
         'password' => $this->password,
         'status' => $this->status,
         'created_at' => $this->created_at,
         'updated_at' => $this->updated_at,
      ];
   }


   public function getBranchId()
   {
      return $this->branch_id;
   }

   public function getBranchName()
   {
      return $this->branch_name;
   }

   public function getFirstName()
   {
      return $this->first_name;
   }

   public function getLastName()
   {
      return $this->last_name;
   }

   public function getAddress()
   {
      return $this->address;
   }

   public function getPhoneNumber()
   {
      return $this->phone_number;
   }

   public function getEmail()
   {
      return  $this->email;
   }

   public function getPassword()
   {
      return $this->password;
   }

   public function getStatus()
   {
      return $this->status;
   }

   public function getCreatedAt()
   {
      return $this->created_at;
   }

   public function getUpdatedAt()
   {
      return $this->updated_at;
   }
}
