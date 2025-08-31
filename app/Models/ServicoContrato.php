<?php

class ServicoContrato extends TRecord
{
    const TABLENAME  = 'servico_contrato';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const MOVEIS_PLANEJADOS = '1';
    const OTICAS = '2';
    const MARMORARIA = '3';
    const ENERGIA_SOLAR = '4';



    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('cor');
        parent::addAttribute('chave');

    }

    /**
     * Method getContratos
     */
    public function getContratos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('servico_contrato_id', '=', $this->id));
        return Contrato::getObjects( $criteria );
    }
    /**
     * Method getLeadss
     */
    public function getLeadss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('servico_contrato_id', '=', $this->id));
        return Leads::getObjects( $criteria );
    }
    /**
     * Method getNegociacaos
     */
    public function getNegociacaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('servico_contrato', '=', $this->id));
        return Negociacao::getObjects( $criteria );
    }

    public function set_contrato_loja_to_string($contrato_loja_to_string)
    {
        if(is_array($contrato_loja_to_string))
        {
            $values = Loja::where('id', 'in', $contrato_loja_to_string)->getIndexedArray('nome_loja', 'nome_loja');
            $this->contrato_loja_to_string = implode(', ', $values);
        }
        else
        {
            $this->contrato_loja_to_string = $contrato_loja_to_string;
        }

        $this->vdata['contrato_loja_to_string'] = $this->contrato_loja_to_string;
    }

    public function get_contrato_loja_to_string()
    {
        if(!empty($this->contrato_loja_to_string))
        {
            return $this->contrato_loja_to_string;
        }

        $values = Contrato::where('servico_contrato_id', '=', $this->id)->getIndexedArray('loja_id','{loja->nome_loja}');
        return implode(', ', $values);
    }

    public function set_contrato_contrato_status_to_string($contrato_contrato_status_to_string)
    {
        if(is_array($contrato_contrato_status_to_string))
        {
            $values = ContratoStatus::where('id', 'in', $contrato_contrato_status_to_string)->getIndexedArray('nome', 'nome');
            $this->contrato_contrato_status_to_string = implode(', ', $values);
        }
        else
        {
            $this->contrato_contrato_status_to_string = $contrato_contrato_status_to_string;
        }

        $this->vdata['contrato_contrato_status_to_string'] = $this->contrato_contrato_status_to_string;
    }

    public function get_contrato_contrato_status_to_string()
    {
        if(!empty($this->contrato_contrato_status_to_string))
        {
            return $this->contrato_contrato_status_to_string;
        }

        $values = Contrato::where('servico_contrato_id', '=', $this->id)->getIndexedArray('contrato_status_id','{contrato_status->nome}');
        return implode(', ', $values);
    }

    public function set_contrato_servico_contrato_to_string($contrato_servico_contrato_to_string)
    {
        if(is_array($contrato_servico_contrato_to_string))
        {
            $values = ServicoContrato::where('id', 'in', $contrato_servico_contrato_to_string)->getIndexedArray('nome', 'nome');
            $this->contrato_servico_contrato_to_string = implode(', ', $values);
        }
        else
        {
            $this->contrato_servico_contrato_to_string = $contrato_servico_contrato_to_string;
        }

        $this->vdata['contrato_servico_contrato_to_string'] = $this->contrato_servico_contrato_to_string;
    }

    public function get_contrato_servico_contrato_to_string()
    {
        if(!empty($this->contrato_servico_contrato_to_string))
        {
            return $this->contrato_servico_contrato_to_string;
        }

        $values = Contrato::where('servico_contrato_id', '=', $this->id)->getIndexedArray('servico_contrato_id','{servico_contrato->nome}');
        return implode(', ', $values);
    }

    public function set_leads_lead_status_to_string($leads_lead_status_to_string)
    {
        if(is_array($leads_lead_status_to_string))
        {
            $values = LeadStatus::where('id', 'in', $leads_lead_status_to_string)->getIndexedArray('nome', 'nome');
            $this->leads_lead_status_to_string = implode(', ', $values);
        }
        else
        {
            $this->leads_lead_status_to_string = $leads_lead_status_to_string;
        }

        $this->vdata['leads_lead_status_to_string'] = $this->leads_lead_status_to_string;
    }

    public function get_leads_lead_status_to_string()
    {
        if(!empty($this->leads_lead_status_to_string))
        {
            return $this->leads_lead_status_to_string;
        }

        $values = Leads::where('servico_contrato_id', '=', $this->id)->getIndexedArray('lead_status_id','{lead_status->nome}');
        return implode(', ', $values);
    }

    public function set_leads_servico_contrato_to_string($leads_servico_contrato_to_string)
    {
        if(is_array($leads_servico_contrato_to_string))
        {
            $values = ServicoContrato::where('id', 'in', $leads_servico_contrato_to_string)->getIndexedArray('nome', 'nome');
            $this->leads_servico_contrato_to_string = implode(', ', $values);
        }
        else
        {
            $this->leads_servico_contrato_to_string = $leads_servico_contrato_to_string;
        }

        $this->vdata['leads_servico_contrato_to_string'] = $this->leads_servico_contrato_to_string;
    }

    public function get_leads_servico_contrato_to_string()
    {
        if(!empty($this->leads_servico_contrato_to_string))
        {
            return $this->leads_servico_contrato_to_string;
        }

        $values = Leads::where('servico_contrato_id', '=', $this->id)->getIndexedArray('servico_contrato_id','{servico_contrato->nome}');
        return implode(', ', $values);
    }

    public function set_leads_lead_origem_to_string($leads_lead_origem_to_string)
    {
        if(is_array($leads_lead_origem_to_string))
        {
            $values = LeadOrigem::where('id', 'in', $leads_lead_origem_to_string)->getIndexedArray('id', 'id');
            $this->leads_lead_origem_to_string = implode(', ', $values);
        }
        else
        {
            $this->leads_lead_origem_to_string = $leads_lead_origem_to_string;
        }

        $this->vdata['leads_lead_origem_to_string'] = $this->leads_lead_origem_to_string;
    }

    public function get_leads_lead_origem_to_string()
    {
        if(!empty($this->leads_lead_origem_to_string))
        {
            return $this->leads_lead_origem_to_string;
        }

        $values = Leads::where('servico_contrato_id', '=', $this->id)->getIndexedArray('lead_origem_id','{lead_origem->id}');
        return implode(', ', $values);
    }

    public function set_leads_fk_deletado_por_to_string($leads_fk_deletado_por_to_string)
    {
        if(is_array($leads_fk_deletado_por_to_string))
        {
            $values = SystemUsers::where('id', 'in', $leads_fk_deletado_por_to_string)->getIndexedArray('name', 'name');
            $this->leads_fk_deletado_por_to_string = implode(', ', $values);
        }
        else
        {
            $this->leads_fk_deletado_por_to_string = $leads_fk_deletado_por_to_string;
        }

        $this->vdata['leads_fk_deletado_por_to_string'] = $this->leads_fk_deletado_por_to_string;
    }

    public function get_leads_fk_deletado_por_to_string()
    {
        if(!empty($this->leads_fk_deletado_por_to_string))
        {
            return $this->leads_fk_deletado_por_to_string;
        }

        $values = Leads::where('servico_contrato_id', '=', $this->id)->getIndexedArray('deletado_por','{fk_deletado_por->name}');
        return implode(', ', $values);
    }

    public function set_negociacao_negociacao_status_to_string($negociacao_negociacao_status_to_string)
    {
        if(is_array($negociacao_negociacao_status_to_string))
        {
            $values = NegociacaoStatus::where('id', 'in', $negociacao_negociacao_status_to_string)->getIndexedArray('nome', 'nome');
            $this->negociacao_negociacao_status_to_string = implode(', ', $values);
        }
        else
        {
            $this->negociacao_negociacao_status_to_string = $negociacao_negociacao_status_to_string;
        }

        $this->vdata['negociacao_negociacao_status_to_string'] = $this->negociacao_negociacao_status_to_string;
    }

    public function get_negociacao_negociacao_status_to_string()
    {
        if(!empty($this->negociacao_negociacao_status_to_string))
        {
            return $this->negociacao_negociacao_status_to_string;
        }

        $values = Negociacao::where('servico_contrato', '=', $this->id)->getIndexedArray('negociacao_status_id','{negociacao_status->nome}');
        return implode(', ', $values);
    }

    public function set_negociacao_fk_servico_contrato_to_string($negociacao_fk_servico_contrato_to_string)
    {
        if(is_array($negociacao_fk_servico_contrato_to_string))
        {
            $values = ServicoContrato::where('id', 'in', $negociacao_fk_servico_contrato_to_string)->getIndexedArray('nome', 'nome');
            $this->negociacao_fk_servico_contrato_to_string = implode(', ', $values);
        }
        else
        {
            $this->negociacao_fk_servico_contrato_to_string = $negociacao_fk_servico_contrato_to_string;
        }

        $this->vdata['negociacao_fk_servico_contrato_to_string'] = $this->negociacao_fk_servico_contrato_to_string;
    }

    public function get_negociacao_fk_servico_contrato_to_string()
    {
        if(!empty($this->negociacao_fk_servico_contrato_to_string))
        {
            return $this->negociacao_fk_servico_contrato_to_string;
        }

        $values = Negociacao::where('servico_contrato', '=', $this->id)->getIndexedArray('servico_contrato','{fk_servico_contrato->nome}');
        return implode(', ', $values);
    }

    public function set_negociacao_usuario_to_string($negociacao_usuario_to_string)
    {
        if(is_array($negociacao_usuario_to_string))
        {
            $values = SystemUsers::where('id', 'in', $negociacao_usuario_to_string)->getIndexedArray('name', 'name');
            $this->negociacao_usuario_to_string = implode(', ', $values);
        }
        else
        {
            $this->negociacao_usuario_to_string = $negociacao_usuario_to_string;
        }

        $this->vdata['negociacao_usuario_to_string'] = $this->negociacao_usuario_to_string;
    }

    public function get_negociacao_usuario_to_string()
    {
        if(!empty($this->negociacao_usuario_to_string))
        {
            return $this->negociacao_usuario_to_string;
        }

        $values = Negociacao::where('servico_contrato', '=', $this->id)->getIndexedArray('usuario_id','{usuario->name}');
        return implode(', ', $values);
    }

    public function set_negociacao_controle_negociacao_to_string($negociacao_controle_negociacao_to_string)
    {
        if(is_array($negociacao_controle_negociacao_to_string))
        {
            $values = ControleNegociacao::where('id', 'in', $negociacao_controle_negociacao_to_string)->getIndexedArray('nome', 'nome');
            $this->negociacao_controle_negociacao_to_string = implode(', ', $values);
        }
        else
        {
            $this->negociacao_controle_negociacao_to_string = $negociacao_controle_negociacao_to_string;
        }

        $this->vdata['negociacao_controle_negociacao_to_string'] = $this->negociacao_controle_negociacao_to_string;
    }

    public function get_negociacao_controle_negociacao_to_string()
    {
        if(!empty($this->negociacao_controle_negociacao_to_string))
        {
            return $this->negociacao_controle_negociacao_to_string;
        }

        $values = Negociacao::where('servico_contrato', '=', $this->id)->getIndexedArray('controle_negociacao_id','{controle_negociacao->nome}');
        return implode(', ', $values);
    }


}
