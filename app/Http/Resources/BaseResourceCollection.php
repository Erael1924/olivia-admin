<?php

namespace App\Http\Resources;

use App\Support\ApiResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;

class BaseResourceCollection extends ResourceCollection
{
    /**
     * The name of the resource being collected.
     *
     * @var string
     */
    public $collects;

    /**
     * Create a new anonymous resource collection.
     *
     * @param string $collects
     *
     * @return void
     */
    public function __construct($resource, $collects)
    {
        $this->collects = $collects;

        parent::__construct($resource);
    }

    private $message = ApiResponse::SUCCESS;

    public function withMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function with($request)
    {
        $this->message['message'] = __($this->message['message']);

        return ['meta' => $this->message];
    }

    /**
     * Add the pagination information to the response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function paginationInformation($request, $paginated, $default)
    {
        return Arr::only($paginated, 'pagination');
    }
}
