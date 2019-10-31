<?php

namespace Demency\NovaGridder;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class NovaGridderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-gridder', __DIR__ . '/../dist/js/field.js');
            Nova::style('nova-gridder', __DIR__ . '/../dist/css/field.css');
        });

        $this->app->booted(function () {
            Field::macro('gridder', function ($options = []) {
                return $this->withMeta(['gridder' => [
                    'labelSize' => $options['labelSize'] ?? 'w-1/4',
                    'contentSize' => $options['contentSize'] ?? 'w-3/4',
                    'panelSize' => $options['panelSize'] ?? 'w-full',
                    'additionalLabelClasses' => $options['additionalLabelClasses'] ?? '',
                    'additionalContentClasses' => $options['additionalContentClasses'] ?? 'break-words py-2',
                    'additionalPanelClasses' => $options['additionalPanelClasses'] ?? 'border-b border-40',
                ]]);
            });
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
