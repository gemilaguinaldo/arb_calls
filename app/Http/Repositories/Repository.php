<?php

namespace App\Http\Repositories;

use App\Traits\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class Repository
{
    use Response;
    
    public function all(){
        return $this->model->all();
    }

    public function all_where($where = []){
        foreach ($where as $key => $value) {
            $this->model = $this->model->where($key, $value);
        }
        return $this->model->get();
    }
    
    public function create(array $data){
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
        
    public function update(array $data, $id){
        $record = $this->model->find($id);
        if($record){
            try {
                $record->update($data);
                return $record;
            } catch (QueryException $e) {
                Log::error($e->getMessage());
                return false;
            }
        }
        return false;
    }
        
    public function delete($id){
        try {
            $user = $this->model->find($id);
            if($user){
                $user->delete();
                return true;
            }
            return false;
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function show($id){
        return $this->model->find($id);
    }
}
