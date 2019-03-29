<?php

namespace ShareManT\IHelper;

use Encore\Admin\Admin;
use Illuminate\Support\ServiceProvider;

class IHelperServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(IHelper $extension)
    {
        if (!IHelper::boot()) {
            return;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-ext-ihelper');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/ihelper')],
                'laravel-admin-ext-ihelper'
            );
        }

        Admin::booting(function () {
            Admin::js('vendor/laravel-admin-ext/ihelper/ihelper.js');
            Admin::css('vendor/laravel-admin-ext/ihelper/ihelper.css');
        });

    }
}