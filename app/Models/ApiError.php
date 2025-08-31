<?php

class ApiError extends TRecord
{
    const TABLENAME  = 'api_error';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'cadastrado_em';
    const UPDATEDAT  = 'atualizado_em';



    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('url');
        parent::addAttribute('error_message');
        parent::addAttribute('cadastrado_em');
        parent::addAttribute('atualizado_em');

    }


}
