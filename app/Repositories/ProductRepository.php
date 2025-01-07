<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\{
    Products,
    ProductVariants,
    Variants,
    OrderDetails
};


class ProductRepository implements ProductRepositoryInterface
{
    public function search(array $filters = [], string $stockFilter = "", array $orderBy = [], int $page = 10):LengthAwarePaginator | Collection
    {
        $query = Products::with(['collection', 'category', 'subCategory', 'variants' => function ($query) use ($stockFilter) {
            $query->select('product_id',
                DB::raw('SUM(stock) as total_stock'),
                DB::raw('SUM(sold) as total_sold'),
                DB::raw('MIN(price) as min_price'),
                DB::raw('MAX(price) as max_price')
            );
            switch($stockFilter) {
                case "in_stock":
                    $query->having('total_stock', '>', 10);
                    break;
                case "low_stock":
                    $query->havingBetween('total_stock', [1, 10]);
                    break;
                case "no_stock":
                    $query->having('total_stock', '=', 0);
                    break;
                default:
                    // No additional filtering
                    break;
            }

            $query->groupBy('product_id');
        }]);

        if(!empty($filters)){
            foreach ($filters as $key => $field) {

                if(isset($field['raw']) && $field['raw']){
                    $operator = $field['operator'] == 'greater' ? '>' : '<';
                    $query->where(DB::raw($field['query']), $operator, $field['value']);
                }else{
                    switch($field['operator']){
                        case 'between':
                            $query->whereBetween($key, [$field['value'][0], $field['value'][1]]);
                            break;
                        case 'like':
                            $query->where($key, 'like', '%' . $field['value'] . '%');
                            break;
                        case 'array':
                            $query->where($key, $field['value'][0], $field['value'][1]);
                            break;
                        case 'equal':
                            $query->where($key, $field['value']);
                            break;
                        default:
                            $query->where($key, $field['value']);
                    }
                }
            }
        }

        if(!empty($orderBy)){
            foreach ($orderBy as $key => $value) {
                if ($value == 'asc') {
                    $query->orderBy($key);
                } else {
                    $query->orderByDesc($key);
                }
            }
        }

        return $query->paginate($page);
    }

    public function removeVariant($id)
    {
        $variant = Variants::find($id);
        $count = OrderDetails::where("variant_id", $id)->count();
        if($count > 0){
           $variant->status = 6;
           $variant->save();
        }else{
           $variant->delete();
        }
    }

    public function removeVariantOption($option, $optionLevel)
    {
        $option = ProductVariants::find($option);
        $count = OrderDetails::where($optionLevel, $option->second_option)->count();
        if($count > 0){
           $option->status = 6;
           $option->save();
        }else{
           $option->delete();
        }
    }
}
