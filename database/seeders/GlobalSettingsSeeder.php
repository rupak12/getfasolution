<?php

namespace Database\Seeders;

use App\Models\GlobalSetting;
use Illuminate\Database\Seeder;

class GlobalSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = GlobalSetting::query()->firstOrCreate([], GlobalSetting::defaults());

        foreach (GlobalSetting::defaults() as $key => $value) {
            if (($settings->{$key} === null || $settings->{$key} === '') && $value !== null && $value !== '') {
                $settings->{$key} = $value;
            }
        }

        $settings->save();
        GlobalSetting::refreshCache();
    }
}
