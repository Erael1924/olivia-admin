<?php

namespace App\Http\Resources;

use App\Support\ApiResponse;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Carbon\Carbon;

class BaseResource extends JsonResource
{
    private $message = ApiResponse::SUCCESS;

    public function withMessage($message): self
    {
        $this->message = $message;

        return $this;
    }

    public function with($request): mixed
    {
        $this->message['message'] = __($this->message['message']);

        return ['meta' => $this->message];
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request): array|Arrayable|\JsonSerializable
    {
        if (is_null($this->resource)) {
            return [];
        }

        return $this->responseArray($request);
    }

    public function responseArray(Request $request): array|Arrayable|\JsonSerializable
    {
        return parent::toArray($request);
    }

    public static function collection($resource): ResourceCollection
    {
        return tap(new BaseResourceCollection($resource, static::class), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                /* @phpstan-ignore-next-line */
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        });
    }

    public function dateTimeFormat($dateTime): string
    {
        if (empty($dateTime)) {
            return '';
        }

        return Carbon::parse($dateTime)->format('Y-m-d H:i:s');
    }

    public static function getStatusName($statusCode)
    {
        $statusMap = [
            1 => 'draft',
            2 => 'pending',
            3 => 'published',
            4 => 'unpublished',
            5 => 'active',
            6 => 'inactive',
            7 => 'deactivated',
            8 => 'ongoing',
            9 => 'expired',
            10 => 'on hold',
            11 => 'closed',
        ];
        return $statusMap[$statusCode] ?? 'Unknown'; // Return 'Unknown' if the status is not found
    }
}
