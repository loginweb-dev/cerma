<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class BlockEdit extends AbstractAction
{
    public function getTitle()
    {
        return 'Edit';
    }

    public function getIcon()
    {
        return 'voyager-pen';
    }

    public function getPolicy()
    {
        return 'browse';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-dark',
        ];
    }

    public function getDefaultRoute()
    {
        return route('page_edit', $this->data->{$this->data->getKeyName()});
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'pages';
    }

    // public function massAction($ids, $comingFrom)
    // {
    //     return redirect()->route('voyager.blocks.index');
    // }
}