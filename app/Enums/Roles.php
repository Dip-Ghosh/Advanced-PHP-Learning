<?php

namespace App\Enums;

enum Roles: string
{
    case ADMIN      = 'admin';
    case INSTRUCTOR = 'instructor';
    case STUDENT    = 'student';
    case MEMBER     = 'member';
}