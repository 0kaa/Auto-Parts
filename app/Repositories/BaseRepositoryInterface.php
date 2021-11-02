<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{

    public function create(array $data);

    public function CreateMulti(array $data);

    public function update(array $data, $id);

    public function getAll($orderBy);

    public function updateWhere(array $data, array $data2);

    public function delete($id);

    public function getCount();

    public function deleteAll();

    public function deleteWhere(array $data);

    public function forceDelete($id);

    public function forceDeleteWhere(array $data);

    public function whereHas($relation, array $data, array $data2, $orderBy);

    public function getWhereIn( $col,array $data,array $data2, $orderBy );

    public function whereHasWith(array $with, $relation, array $data, array $data2, array $data3,array $data4, $orderBy);


    public function whereHasWithUpdate(array $with, $relation, array $data, array $data2 = [], array $data_update);

    public function whereHasWithPaginate(array $with, $relation, array $data, array $data2, $orderBy,$num_paginate);

    public function whereHasWithFirst(array $with, $relation, array $data, array $data2, $orderBy);

    public function getAllTrashed($orderBy);

    public function restoreAllTrashed();

    public function getWhereDate($column, $date, $data , $symbol, $orderBy);

    public function restoreOneTrashed($id);

    public function getWhere(array $data, $orderBy);

    public function getWith(array $data, $orderBy);

    public function paginateWith(array $data, $orderBy, $limit);

    public function paginate($limit, $orderBy);

    public function findOne($id);

    public function findWhere(array $data);

    public function findWhereWith(array $data2, array $data);

    public function findWith($id, array $data);

    public function getWhereWith(array $with, array $data, $orderBy);

    public function findWithTrashed($id);

    public function findWithDataAndTrashed($id, array $data);

    public function search(array $where, array $columns,$search_query, $orderBy);

    public function searchWithWhereHas(array $with, array $where = ['id', '>', 0],array $columns, $searchQuery,$relation_arr,$var, $arr_data ,$orderBy = ['column' => 'id', 'dir' => 'DESC']);


}
