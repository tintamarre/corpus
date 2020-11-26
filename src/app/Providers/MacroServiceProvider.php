<?php

namespace App\Providers;

use Collective\Html\HtmlServiceProvider;

class MacroServiceProvider extends HtmlServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        // Macros must be loaded after the HTMLServiceProvider's
        // register method is called. Otherwise, csrf tokens
        // will not be generated
        parent::register();

        // Load macros
        require app_path('Services/macros_Html.php');
        require app_path('Services/macros_Form.php');
    }
}
