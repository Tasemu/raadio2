<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use Storage;

class BaseComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('user', Auth::user());
    }
}