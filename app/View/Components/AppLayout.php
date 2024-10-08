<?php

namespace App\View\Components;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    use SEOTools;

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $this->seo()->metatags()->removeMeta('name', 'robots');
        return view('layouts.app');
    }
}
