<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $count=1;
        $setting = $this->findSetting('site.title');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.title'),
                'value'        => 'cerma v1.0',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.description'),
                'value'        => __('voyager::seeders.settings.site.description'),
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.logo');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.logo'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => $count++,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.google_analytics_tracking_id');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.google_analytics_tracking_id'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.page');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Pagina',
                'value'        => null,
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('admin.bg_image');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.background_image'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.title');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.title'),
                'value'        => 'cerma v1.0',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.description'),
                'value'        => __('voyager::seeders.settings.admin.description_value'),
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.loader');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.loader'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.icon_image');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.icon_image'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.google_analytics_client_id');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.google_analytics_client_id'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }
    }

    /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findSetting($key)
    {
        return Setting::firstOrNew(['key' => $key]);
    }
}
