<?php

class ViewRenovaInativos extends TRecord
{
    const TABLENAME  = 'view_renova_inativos';
    const PRIMARYKEY = 'ID';
    const IDPOLICY   =  'max'; // {max, serial}



    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('LOJA');
        parent::addAttribute('RESPONSAVEL');
        parent::addAttribute('TELEFONE');
        parent::addAttribute('TELEFONE_FINANCEIRO');

    }


}
