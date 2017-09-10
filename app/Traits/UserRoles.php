<?php

namespace App\Traits;

trait UserRoles
{
    /**
     * An authenticated user has one or multiple roles.
     *
     * @param  string or coll  $role
     * @return boolean
     */
    public function hasRole($role)
    {
        //$role is a string
        if (is_string($role))
        {
            return $this->roles->contains('name', $role);
        }

        //$role is int
        return (bool) $role->intersect($this->roles)->count();
    }

    /**
     * An authenticated user is admin.
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * An authenticated user is student.
     *
     * @return boolean
     */
    public function isStudent()
    {
        return $this->hasRole('student');
    }

    /**
     * An authenticated user is teacher.
     *
     * @return boolean
     */
    public function isTeacher()
    {
        return $this->hasRole('teacher');
    }

    /**
     * An authenticated user is parent.
     *
     * @return boolean
     */
    public function isParent()
    {
        return $this->hasRole('parent');
    }

    /**
     * An authenticated userParenteradmin.
     *
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return $this->hasRole('superadmin');
    }

}