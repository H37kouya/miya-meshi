<?php

namespace App\Http;

use App\Http\Requests\Traits\JsonRequest;
use Illuminate\Http\Request as BaseRequest;

class Request extends BaseRequest
{
    use JsonRequest;
}
