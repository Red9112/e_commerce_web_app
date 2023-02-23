<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;


    public function before(User $user, $ability)
    {
   if ($user->hasRole('admin') &&
      in_array($ability,['edit','update','delete','viewAny']))
      return true;
    }
    public function viewAny(User $user)
    {
        return ($user->hasRole('admin'));
    }

    public function update(User $user, Payment $payment)
    {
        return ($user->id == $payment->user->id);
    }
    public function edit(User $user, Payment $payment)
    {
        return ($user->id == $payment->user->id);
    }

    public function delete(User $user, Payment $payment)
    {
        return ($user->id == $payment->user->id);
    }


    public function restore(User $user, Payment $payment)
    {
        //
    }


    public function forceDelete(User $user, Payment $payment)
    {
        //
    }
}
