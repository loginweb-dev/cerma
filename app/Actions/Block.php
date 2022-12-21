<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Block extends AbstractAction
{
    public function getTitle()
    {
        return 'Blocks';
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
            'class' => 'btn btn-success pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('block_index', $this->data->{$this->data->getKeyName()});
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