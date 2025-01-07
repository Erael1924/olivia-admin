<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Roles;

class BaseRepository implements BaseRepositoryInterface
{
    public function all(): Collection
    {
        return AuditLogs::all();
    }

    public function search(string $modelClass, array $filters = [], array $select = ['*'], array $relation = [], array $joins = [], array $orderBy = [], bool $isCollection = false, int $page = 10):LengthAwarePaginator | Collection
    {
        $query = $modelClass::select($select);

        foreach ($joins as $join) {
            if (isset($join['table'], $join['first'], $join['operator'], $join['second'], $join['type'])) {
                $query->join(
                    $join['table'],
                    $join['first'],
                    $join['operator'],
                    $join['second'],
                    $join['type'] ?? 'inner'
                );
            }
        }

        if (!empty($relation)) {
            $query->with($relation);
        }

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

        return $isCollection ? $query->get() : $query->paginate($page);
    }

    public function create(string $modelClass, array $data = [])
    {
        return $modelClass::create($data);
    }

    public function update(string $modelClass, string $key, mixed $value, array $data = [])
    {
        return $modelClass::where($key, '=', $value)->update($data);
    }

    public function delete(string $modelClass, string $key, mixed $value)
    {
        return $modelClass::where($key, '=', $value)->delete();
    }

    public function deleteWhereIn(string $modelClass, string $key, array $value){
        return $modelClass::whereIn($key, $value)->delete();
    }

}
