<?php

class Loja extends TRecord
{
    const TABLENAME  = 'loja';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const DELETED_BY_USER_ID  = 'deletado_por';

    const DELETEDAT  = 'deletado_em';
    const CREATEDAT  = 'cadastrado_em';
    const UPDATEDAT  = 'atualizado_em';

    private $unidade;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome_loja');
        parent::addAttribute('nome');
        parent::addAttribute('documento');
        parent::addAttribute('razao_social');
        parent::addAttribute('telefone');
        parent::addAttribute('unidade_id');
        parent::addAttribute('cadastrado_em');
        parent::addAttribute('atualizado_em');
        parent::addAttribute('origem');
        parent::addAttribute('email');
        parent::addAttribute('cep');
        parent::addAttribute('limite_envio');
        parent::addAttribute('website');
        parent::addAttribute('telefone_financeiro');
        parent::addAttribute('instagram');
        parent::addAttribute('address');
        parent::addAttribute('deletado_em');
        parent::addAttribute('deletado_por');

    }

    /**
     * Method set_system_unit
     * Sample of usage: $var->system_unit = $object;
     * @param $object Instance of SystemUnit
     */
    public function set_unidade(SystemUnit $object)
    {
        $this->unidade = $object;
        $this->unidade_id = $object->id;
    }

    /**
     * Method get_unidade
     * Sample of usage: $var->unidade->attribute;
     * @returns SystemUnit instance
     */
    public function get_unidade()
    {

        // loads the associated object
        if (empty($this->unidade))
            $this->unidade = new SystemUnit($this->unidade_id);

        // returns the associated object
        return $this->unidade;
    }

    /**
     * Method getAfiliadoss
     */
    public function getAfiliadoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('loja_id', '=', $this->id));
        return Afiliados::getObjects( $criteria );
    }
    /**
     * Method getContratos
     */
    public function getContratos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('loja_id', '=', $this->id));
        return Contrato::getObjects( $criteria );
    }
    /**
     * Method getCupomUserss
     */
    public function getCupomUserss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('loja_id', '=', $this->id));
        return CupomUsers::getObjects( $criteria );
    }
    /**
     * Method getLojaGeolocalizacaos
     */
    public function getLojaGeolocalizacaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('loja_id', '=', $this->id));
        return LojaGeolocalizacao::getObjects( $criteria );
    }
    /**
     * Method getLojaContatos
     */
    public function getLojaContatos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('loja_id', '=', $this->id));
        return LojaContato::getObjects( $criteria );
    }
    /**
     * Method getCupoms
     */
    public function getCupoms()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('loja_id', '=', $this->id));
        return Cupom::getObjects( $criteria );
    }
    /**
     * Method getGruposLojas
     */
    public function getGruposLojas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('loja_id', '=', $this->id));
        return GruposLoja::getObjects( $criteria );
    }
    /**
     * Method getChamados
     */
    public function getChamados()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('loja_id', '=', $this->id));
        return Chamado::getObjects( $criteria );
    }

    public function set_afiliados_fk_userid_to_string($afiliados_fk_userid_to_string)
    {
        if(is_array($afiliados_fk_userid_to_string))
        {
            $values = SystemUsers::where('id', 'in', $afiliados_fk_userid_to_string)->getIndexedArray('name', 'name');
            $this->afiliados_fk_userid_to_string = implode(', ', $values);
        }
        else
        {
            $this->afiliados_fk_userid_to_string = $afiliados_fk_userid_to_string;
        }

        $this->vdata['afiliados_fk_userid_to_string'] = $this->afiliados_fk_userid_to_string;
    }

    public function get_afiliados_fk_userid_to_string()
    {
        if(!empty($this->afiliados_fk_userid_to_string))
        {
            return $this->afiliados_fk_userid_to_string;
        }

        $values = Afiliados::where('loja_id', '=', $this->id)->getIndexedArray('userid','{fk_userid->name}');
        return implode(', ', $values);
    }

    public function set_afiliados_loja_to_string($afiliados_loja_to_string)
    {
        if(is_array($afiliados_loja_to_string))
        {
            $values = Loja::where('id', 'in', $afiliados_loja_to_string)->getIndexedArray('nome_loja', 'nome_loja');
            $this->afiliados_loja_to_string = implode(', ', $values);
        }
        else
        {
            $this->afiliados_loja_to_string = $afiliados_loja_to_string;
        }

        $this->vdata['afiliados_loja_to_string'] = $this->afiliados_loja_to_string;
    }

    public function get_afiliados_loja_to_string()
    {
        if(!empty($this->afiliados_loja_to_string))
        {
            return $this->afiliados_loja_to_string;
        }

        $values = Afiliados::where('loja_id', '=', $this->id)->getIndexedArray('loja_id','{loja->nome_loja}');
        return implode(', ', $values);
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

        $values = Contrato::where('loja_id', '=', $this->id)->getIndexedArray('loja_id','{loja->nome_loja}');
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

        $values = Contrato::where('loja_id', '=', $this->id)->getIndexedArray('contrato_status_id','{contrato_status->nome}');
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

        $values = Contrato::where('loja_id', '=', $this->id)->getIndexedArray('servico_contrato_id','{servico_contrato->nome}');
        return implode(', ', $values);
    }

    public function set_cupom_users_loja_to_string($cupom_users_loja_to_string)
    {
        if(is_array($cupom_users_loja_to_string))
        {
            $values = Loja::where('id', 'in', $cupom_users_loja_to_string)->getIndexedArray('nome_loja', 'nome_loja');
            $this->cupom_users_loja_to_string = implode(', ', $values);
        }
        else
        {
            $this->cupom_users_loja_to_string = $cupom_users_loja_to_string;
        }

        $this->vdata['cupom_users_loja_to_string'] = $this->cupom_users_loja_to_string;
    }

    public function get_cupom_users_loja_to_string()
    {
        if(!empty($this->cupom_users_loja_to_string))
        {
            return $this->cupom_users_loja_to_string;
        }

        $values = CupomUsers::where('loja_id', '=', $this->id)->getIndexedArray('loja_id','{loja->nome_loja}');
        return implode(', ', $values);
    }

    public function set_cupom_users_cupom_to_string($cupom_users_cupom_to_string)
    {
        if(is_array($cupom_users_cupom_to_string))
        {
            $values = Cupom::where('id', 'in', $cupom_users_cupom_to_string)->getIndexedArray('id', 'id');
            $this->cupom_users_cupom_to_string = implode(', ', $values);
        }
        else
        {
            $this->cupom_users_cupom_to_string = $cupom_users_cupom_to_string;
        }

        $this->vdata['cupom_users_cupom_to_string'] = $this->cupom_users_cupom_to_string;
    }

    public function get_cupom_users_cupom_to_string()
    {
        if(!empty($this->cupom_users_cupom_to_string))
        {
            return $this->cupom_users_cupom_to_string;
        }

        $values = CupomUsers::where('loja_id', '=', $this->id)->getIndexedArray('cupom_id','{cupom->id}');
        return implode(', ', $values);
    }

    public function set_loja_geolocalizacao_loja_to_string($loja_geolocalizacao_loja_to_string)
    {
        if(is_array($loja_geolocalizacao_loja_to_string))
        {
            $values = Loja::where('id', 'in', $loja_geolocalizacao_loja_to_string)->getIndexedArray('nome_loja', 'nome_loja');
            $this->loja_geolocalizacao_loja_to_string = implode(', ', $values);
        }
        else
        {
            $this->loja_geolocalizacao_loja_to_string = $loja_geolocalizacao_loja_to_string;
        }

        $this->vdata['loja_geolocalizacao_loja_to_string'] = $this->loja_geolocalizacao_loja_to_string;
    }

    public function get_loja_geolocalizacao_loja_to_string()
    {
        if(!empty($this->loja_geolocalizacao_loja_to_string))
        {
            return $this->loja_geolocalizacao_loja_to_string;
        }

        $values = LojaGeolocalizacao::where('loja_id', '=', $this->id)->getIndexedArray('loja_id','{loja->nome_loja}');
        return implode(', ', $values);
    }

    public function set_loja_contato_loja_to_string($loja_contato_loja_to_string)
    {
        if(is_array($loja_contato_loja_to_string))
        {
            $values = Loja::where('id', 'in', $loja_contato_loja_to_string)->getIndexedArray('nome_loja', 'nome_loja');
            $this->loja_contato_loja_to_string = implode(', ', $values);
        }
        else
        {
            $this->loja_contato_loja_to_string = $loja_contato_loja_to_string;
        }

        $this->vdata['loja_contato_loja_to_string'] = $this->loja_contato_loja_to_string;
    }

    public function get_loja_contato_loja_to_string()
    {
        if(!empty($this->loja_contato_loja_to_string))
        {
            return $this->loja_contato_loja_to_string;
        }

        $values = LojaContato::where('loja_id', '=', $this->id)->getIndexedArray('loja_id','{loja->nome_loja}');
        return implode(', ', $values);
    }

    public function set_cupom_loja_to_string($cupom_loja_to_string)
    {
        if(is_array($cupom_loja_to_string))
        {
            $values = Loja::where('id', 'in', $cupom_loja_to_string)->getIndexedArray('nome_loja', 'nome_loja');
            $this->cupom_loja_to_string = implode(', ', $values);
        }
        else
        {
            $this->cupom_loja_to_string = $cupom_loja_to_string;
        }

        $this->vdata['cupom_loja_to_string'] = $this->cupom_loja_to_string;
    }

    public function get_cupom_loja_to_string()
    {
        if(!empty($this->cupom_loja_to_string))
        {
            return $this->cupom_loja_to_string;
        }

        $values = Cupom::where('loja_id', '=', $this->id)->getIndexedArray('loja_id','{loja->nome_loja}');
        return implode(', ', $values);
    }

    public function set_grupos_loja_grupo_to_string($grupos_loja_grupo_to_string)
    {
        if(is_array($grupos_loja_grupo_to_string))
        {
            $values = Grupo::where('id', 'in', $grupos_loja_grupo_to_string)->getIndexedArray('nome', 'nome');
            $this->grupos_loja_grupo_to_string = implode(', ', $values);
        }
        else
        {
            $this->grupos_loja_grupo_to_string = $grupos_loja_grupo_to_string;
        }

        $this->vdata['grupos_loja_grupo_to_string'] = $this->grupos_loja_grupo_to_string;
    }

    public function get_grupos_loja_grupo_to_string()
    {
        if(!empty($this->grupos_loja_grupo_to_string))
        {
            return $this->grupos_loja_grupo_to_string;
        }

        $values = GruposLoja::where('loja_id', '=', $this->id)->getIndexedArray('grupo_id','{grupo->nome}');
        return implode(', ', $values);
    }

    public function set_grupos_loja_loja_to_string($grupos_loja_loja_to_string)
    {
        if(is_array($grupos_loja_loja_to_string))
        {
            $values = Loja::where('id', 'in', $grupos_loja_loja_to_string)->getIndexedArray('nome_loja', 'nome_loja');
            $this->grupos_loja_loja_to_string = implode(', ', $values);
        }
        else
        {
            $this->grupos_loja_loja_to_string = $grupos_loja_loja_to_string;
        }

        $this->vdata['grupos_loja_loja_to_string'] = $this->grupos_loja_loja_to_string;
    }

    public function get_grupos_loja_loja_to_string()
    {
        if(!empty($this->grupos_loja_loja_to_string))
        {
            return $this->grupos_loja_loja_to_string;
        }

        $values = GruposLoja::where('loja_id', '=', $this->id)->getIndexedArray('loja_id','{loja->nome_loja}');
        return implode(', ', $values);
    }

    public function set_chamado_solicitante_to_string($chamado_solicitante_to_string)
    {
        if(is_array($chamado_solicitante_to_string))
        {
            $values = SystemUsers::where('id', 'in', $chamado_solicitante_to_string)->getIndexedArray('name', 'name');
            $this->chamado_solicitante_to_string = implode(', ', $values);
        }
        else
        {
            $this->chamado_solicitante_to_string = $chamado_solicitante_to_string;
        }

        $this->vdata['chamado_solicitante_to_string'] = $this->chamado_solicitante_to_string;
    }

    public function get_chamado_solicitante_to_string()
    {
        if(!empty($this->chamado_solicitante_to_string))
        {
            return $this->chamado_solicitante_to_string;
        }

        $values = Chamado::where('loja_id', '=', $this->id)->getIndexedArray('solicitante_id','{solicitante->name}');
        return implode(', ', $values);
    }

    public function set_chamado_categoria_to_string($chamado_categoria_to_string)
    {
        if(is_array($chamado_categoria_to_string))
        {
            $values = Categoria::where('id', 'in', $chamado_categoria_to_string)->getIndexedArray('nome', 'nome');
            $this->chamado_categoria_to_string = implode(', ', $values);
        }
        else
        {
            $this->chamado_categoria_to_string = $chamado_categoria_to_string;
        }

        $this->vdata['chamado_categoria_to_string'] = $this->chamado_categoria_to_string;
    }

    public function get_chamado_categoria_to_string()
    {
        if(!empty($this->chamado_categoria_to_string))
        {
            return $this->chamado_categoria_to_string;
        }

        $values = Chamado::where('loja_id', '=', $this->id)->getIndexedArray('categoria_id','{categoria->nome}');
        return implode(', ', $values);
    }

    public function set_chamado_status_to_string($chamado_status_to_string)
    {
        if(is_array($chamado_status_to_string))
        {
            $values = Status::where('id', 'in', $chamado_status_to_string)->getIndexedArray('nome', 'nome');
            $this->chamado_status_to_string = implode(', ', $values);
        }
        else
        {
            $this->chamado_status_to_string = $chamado_status_to_string;
        }

        $this->vdata['chamado_status_to_string'] = $this->chamado_status_to_string;
    }

    public function get_chamado_status_to_string()
    {
        if(!empty($this->chamado_status_to_string))
        {
            return $this->chamado_status_to_string;
        }

        $values = Chamado::where('loja_id', '=', $this->id)->getIndexedArray('status_id','{status->nome}');
        return implode(', ', $values);
    }

    public function set_chamado_prioridade_to_string($chamado_prioridade_to_string)
    {
        if(is_array($chamado_prioridade_to_string))
        {
            $values = Prioridade::where('id', 'in', $chamado_prioridade_to_string)->getIndexedArray('nome', 'nome');
            $this->chamado_prioridade_to_string = implode(', ', $values);
        }
        else
        {
            $this->chamado_prioridade_to_string = $chamado_prioridade_to_string;
        }

        $this->vdata['chamado_prioridade_to_string'] = $this->chamado_prioridade_to_string;
    }

    public function get_chamado_prioridade_to_string()
    {
        if(!empty($this->chamado_prioridade_to_string))
        {
            return $this->chamado_prioridade_to_string;
        }

        $values = Chamado::where('loja_id', '=', $this->id)->getIndexedArray('prioridade_id','{prioridade->nome}');
        return implode(', ', $values);
    }

    public function set_chamado_atendente_to_string($chamado_atendente_to_string)
    {
        if(is_array($chamado_atendente_to_string))
        {
            $values = Atendente::where('id', 'in', $chamado_atendente_to_string)->getIndexedArray('id', 'id');
            $this->chamado_atendente_to_string = implode(', ', $values);
        }
        else
        {
            $this->chamado_atendente_to_string = $chamado_atendente_to_string;
        }

        $this->vdata['chamado_atendente_to_string'] = $this->chamado_atendente_to_string;
    }

    public function get_chamado_atendente_to_string()
    {
        if(!empty($this->chamado_atendente_to_string))
        {
            return $this->chamado_atendente_to_string;
        }

        $values = Chamado::where('loja_id', '=', $this->id)->getIndexedArray('atendente_id','{atendente->id}');
        return implode(', ', $values);
    }

    public function set_chamado_tipo_problema_to_string($chamado_tipo_problema_to_string)
    {
        if(is_array($chamado_tipo_problema_to_string))
        {
            $values = TipoProblema::where('id', 'in', $chamado_tipo_problema_to_string)->getIndexedArray('nome', 'nome');
            $this->chamado_tipo_problema_to_string = implode(', ', $values);
        }
        else
        {
            $this->chamado_tipo_problema_to_string = $chamado_tipo_problema_to_string;
        }

        $this->vdata['chamado_tipo_problema_to_string'] = $this->chamado_tipo_problema_to_string;
    }

    public function get_chamado_tipo_problema_to_string()
    {
        if(!empty($this->chamado_tipo_problema_to_string))
        {
            return $this->chamado_tipo_problema_to_string;
        }

        $values = Chamado::where('loja_id', '=', $this->id)->getIndexedArray('tipo_problema_id','{tipo_problema->nome}');
        return implode(', ', $values);
    }

    public function set_chamado_tipo_solucao_to_string($chamado_tipo_solucao_to_string)
    {
        if(is_array($chamado_tipo_solucao_to_string))
        {
            $values = TipoSolucao::where('id', 'in', $chamado_tipo_solucao_to_string)->getIndexedArray('nome', 'nome');
            $this->chamado_tipo_solucao_to_string = implode(', ', $values);
        }
        else
        {
            $this->chamado_tipo_solucao_to_string = $chamado_tipo_solucao_to_string;
        }

        $this->vdata['chamado_tipo_solucao_to_string'] = $this->chamado_tipo_solucao_to_string;
    }

    public function get_chamado_tipo_solucao_to_string()
    {
        if(!empty($this->chamado_tipo_solucao_to_string))
        {
            return $this->chamado_tipo_solucao_to_string;
        }

        $values = Chamado::where('loja_id', '=', $this->id)->getIndexedArray('tipo_solucao_id','{tipo_solucao->nome}');
        return implode(', ', $values);
    }

    public function set_chamado_loja_to_string($chamado_loja_to_string)
    {
        if(is_array($chamado_loja_to_string))
        {
            $values = Loja::where('id', 'in', $chamado_loja_to_string)->getIndexedArray('nome_loja', 'nome_loja');
            $this->chamado_loja_to_string = implode(', ', $values);
        }
        else
        {
            $this->chamado_loja_to_string = $chamado_loja_to_string;
        }

        $this->vdata['chamado_loja_to_string'] = $this->chamado_loja_to_string;
    }

    public function get_chamado_loja_to_string()
    {
        if(!empty($this->chamado_loja_to_string))
        {
            return $this->chamado_loja_to_string;
        }

        $values = Chamado::where('loja_id', '=', $this->id)->getIndexedArray('loja_id','{loja->nome_loja}');
        return implode(', ', $values);
    }

    /**
     * Obtém os dados de um CNPJ através da API da ReceitaWS.
     *
     * Faz uma requisição à API da ReceitaWS para obter os dados associados a um CNPJ.
     * O resultado é retornado como um array associativo com as informações do CNPJ.
     *
     * @throws Exception Caso ocorra um erro na requisição ou se o CNPJ não existir.
     *
     * @return array Um array associativo com os dados do CNPJ.
     */
    public function get_dados_cnpj()
    {
        // Inicia uma requisição cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.receitaws.com.br/v1/cnpj/' . $this->documento);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Executa a requisição e obtém o resultado
        $resultado = curl_exec($ch);

        // Decodifica o resultado JSON em um array associativo
        $retorno = json_decode($resultado, true);

        // Verifica o status da requisição e a existência do CNPJ
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200 || array_key_exists('erro', $retorno)) {
            throw new Exception('O CNPJ informado ' . $this->documento . ' não existe');
        }

        // Fecha a requisição cURL
        curl_close($ch);

        // Retorna os dados do CNPJ
        return $retorno;
    }


}
