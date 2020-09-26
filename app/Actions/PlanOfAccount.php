<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class PlanOfAccount extends AbstractAction
{
    public function getTitle()
    {
        return 'Agregar Sub-Cuentas';
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
        return route('add_account', $this->data->{$this->data->getKeyName()});
        // return view('admin.PlanOfAccount.AddAccount', [
        //     'element_id' => $this->data->{$this->data->getKeyName()}
        //     ]
        // );
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'plans-of-accounts';
    }

    // public function massAction($ids, $comingFrom)
    // {
    //     return redirect()->route('voyager.blocks.index');
    // }
}
