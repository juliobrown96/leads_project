<?php

class LeadEnvioStatus extends TRecord
{
    const TABLENAME  = 'lead_envio_status';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const NOVO = '1';
    const VISUALIZADO = '2';
    const DEVOLUCAO = '3';
    const DEVOLVIDO = '4';



    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('cor');

    }

    /**
     * Method getLeadEnvios
     */
    public function getLeadEnvios()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('lead_envio_status_id', '=', $this->id));
        return LeadEnvio::getObjects( $criteria );
    }

    public function set_lead_envio_usuario_to_string($lead_envio_usuario_to_string)
    {
        if(is_array($lead_envio_usuario_to_string))
        {
            $values = SystemUsers::where('id', 'in', $lead_envio_usuario_to_string)->getIndexedArray('name', 'name');
            $this->lead_envio_usuario_to_string = implode(', ', $values);
        }
        else
        {
            $this->lead_envio_usuario_to_string = $lead_envio_usuario_to_string;
        }

        $this->vdata['lead_envio_usuario_to_string'] = $this->lead_envio_usuario_to_string;
    }

    public function get_lead_envio_usuario_to_string()
    {
        if(!empty($this->lead_envio_usuario_to_string))
        {
            return $this->lead_envio_usuario_to_string;
        }

        $values = LeadEnvio::where('lead_envio_status_id', '=', $this->id)->getIndexedArray('usuario_id','{usuario->name}');
        return implode(', ', $values);
    }

    public function set_lead_envio_lead_to_string($lead_envio_lead_to_string)
    {
        if(is_array($lead_envio_lead_to_string))
        {
            $values = Leads::where('id', 'in', $lead_envio_lead_to_string)->getIndexedArray('nome', 'nome');
            $this->lead_envio_lead_to_string = implode(', ', $values);
        }
        else
        {
            $this->lead_envio_lead_to_string = $lead_envio_lead_to_string;
        }

        $this->vdata['lead_envio_lead_to_string'] = $this->lead_envio_lead_to_string;
    }

    public function get_lead_envio_lead_to_string()
    {
        if(!empty($this->lead_envio_lead_to_string))
        {
            return $this->lead_envio_lead_to_string;
        }

        $values = LeadEnvio::where('lead_envio_status_id', '=', $this->id)->getIndexedArray('lead_id','{lead->nome}');
        return implode(', ', $values);
    }

    public function set_lead_envio_contrato_to_string($lead_envio_contrato_to_string)
    {
        if(is_array($lead_envio_contrato_to_string))
        {
            $values = Contrato::where('id', 'in', $lead_envio_contrato_to_string)->getIndexedArray('loja_id', 'loja_id');
            $this->lead_envio_contrato_to_string = implode(', ', $values);
        }
        else
        {
            $this->lead_envio_contrato_to_string = $lead_envio_contrato_to_string;
        }

        $this->vdata['lead_envio_contrato_to_string'] = $this->lead_envio_contrato_to_string;
    }

    public function get_lead_envio_contrato_to_string()
    {
        if(!empty($this->lead_envio_contrato_to_string))
        {
            return $this->lead_envio_contrato_to_string;
        }

        $values = LeadEnvio::where('lead_envio_status_id', '=', $this->id)->getIndexedArray('contrato_id','{contrato->loja_id}');
        return implode(', ', $values);
    }

    public function set_lead_envio_lead_envio_status_to_string($lead_envio_lead_envio_status_to_string)
    {
        if(is_array($lead_envio_lead_envio_status_to_string))
        {
            $values = LeadEnvioStatus::where('id', 'in', $lead_envio_lead_envio_status_to_string)->getIndexedArray('id', 'id');
            $this->lead_envio_lead_envio_status_to_string = implode(', ', $values);
        }
        else
        {
            $this->lead_envio_lead_envio_status_to_string = $lead_envio_lead_envio_status_to_string;
        }

        $this->vdata['lead_envio_lead_envio_status_to_string'] = $this->lead_envio_lead_envio_status_to_string;
    }

    public function get_lead_envio_lead_envio_status_to_string()
    {
        if(!empty($this->lead_envio_lead_envio_status_to_string))
        {
            return $this->lead_envio_lead_envio_status_to_string;
        }

        $values = LeadEnvio::where('lead_envio_status_id', '=', $this->id)->getIndexedArray('lead_envio_status_id','{lead_envio_status->id}');
        return implode(', ', $values);
    }

    public function set_lead_envio_etapa_negociacao_to_string($lead_envio_etapa_negociacao_to_string)
    {
        if(is_array($lead_envio_etapa_negociacao_to_string))
        {
            $values = EtapaNegociacao::where('id', 'in', $lead_envio_etapa_negociacao_to_string)->getIndexedArray('nome', 'nome');
            $this->lead_envio_etapa_negociacao_to_string = implode(', ', $values);
        }
        else
        {
            $this->lead_envio_etapa_negociacao_to_string = $lead_envio_etapa_negociacao_to_string;
        }

        $this->vdata['lead_envio_etapa_negociacao_to_string'] = $this->lead_envio_etapa_negociacao_to_string;
    }

    public function get_lead_envio_etapa_negociacao_to_string()
    {
        if(!empty($this->lead_envio_etapa_negociacao_to_string))
        {
            return $this->lead_envio_etapa_negociacao_to_string;
        }

        $values = LeadEnvio::where('lead_envio_status_id', '=', $this->id)->getIndexedArray('etapa_negociacao_id','{etapa_negociacao->nome}');
        return implode(', ', $values);
    }


}
