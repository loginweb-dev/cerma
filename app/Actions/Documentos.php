<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Documentos extends AbstractAction
{
    public function getTitle()
    {
        return 'Documentos';
    }

    public function getIcon()
    {
        return 'voyager-photos';
    }

    public function getPolicy()
    {
        return 'add';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-success pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('afiliados.documentos', ['id' => $this->data->{$this->data->getKeyName()}]);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'afiliados';
    }
}