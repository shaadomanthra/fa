<?php

namespace App\Policies\Admin;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Admin\Prospect;

class ProspectPolicy
{
    use HandlesAuthorization;

      /**
     * Create a new policy instance.
     *
     * @return void
     */
     public function view(User $user)
    {
        return true;
    }


    /**
     * Determine if the given post can be created by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function create(User $user)
    { 
        if($user->admin!==0)
        return true;
    }


    /**
     * Determine if the given post can be created by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function edit(User $user,Prospect $prospect)
    { 
       
        if($user->admin!==0)
        return true;
    }

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function update(User $user,Prospect $prospect)
    { 
        
        if($user->admin!==0)
        return true;
    }


    public function before($user, $ability)
    {   
        
        if($user->admin!==0)
        return true;
    }
}
