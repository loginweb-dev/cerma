<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Blocks extends AbstractAction
{
    public function getTitle()
    {
        return 'Blockes';
    }

    public function getIcon()
    {
        return 'voyager-tools';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-warning',
        ];
    }

    public function getDefaultRoute()
    {
        // return route('page_edit', $this->data->{$this->data->getKeyName()});
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'pages';
    }

    public function massAction($ids, $comingFrom)
    {
        return redirect()->route('voyager.blocks.index');
    }
}