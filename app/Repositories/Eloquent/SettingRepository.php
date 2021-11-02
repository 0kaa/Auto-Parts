<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting;
use App\Repositories\SettingRepositoryInterface;


class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Setting();
    }

    public function updateSetting($attr)
    {

        foreach ($attr as $key => $value) {
            $this->model->where('key' , $key)->update(['value' => $value]);
        }

        return response()->json();

    }

}
