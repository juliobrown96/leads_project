<?php

class Arquivos extends TRecord
{
    const TABLENAME  = 'arquivos';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'cadastrado_em';

    private $lead;



    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('lead_id');
        parent::addAttribute('nome');
        parent::addAttribute('arquivo');
        parent::addAttribute('cadastrado_em');

    }

    /**
     * Method set_leads
     * Sample of usage: $var->leads = $object;
     * @param $object Instance of Leads
     */
    public function set_lead(Leads $object)
    {
        $this->lead = $object;
        $this->lead_id = $object->id;
    }

    /**
     * Method get_lead
     * Sample of usage: $var->lead->attribute;
     * @returns Leads instance
     */
    public function get_lead()
    {

        // loads the associated object
        if (empty($this->lead))
            $this->lead = new Leads($this->lead_id);

        // returns the associated object
        return $this->lead;
    }


}
