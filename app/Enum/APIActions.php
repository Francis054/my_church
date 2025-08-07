<?php

namespace App\Enum;

enum APIActions: string
{
    case GET = 'get';
    case CREATED = 'created';
    case UPDATED = 'updated';
    case DELETED = 'deleted';
    case VALIDATION = 'validation';
    case SERVER_ERROR = 'server_error';
}
