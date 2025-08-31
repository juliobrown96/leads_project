<?php

class Leads extends TRecord
{
    const TABLENAME  = 'leads';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const DELETED_BY_USER_ID  = 'deletado_por';

    const DELETEDAT  = 'deletado_em';
    const CREATEDAT  = 'cadastrado_em';
    const UPDATEDAT  = 'atualizado_em';

    private $lead_status;
    private $servico_contrato;
    private $lead_origem;
    private $fk_deletado_por;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('lead_status_id');
        parent::addAttribute('servico_contrato_id');
        parent::addAttribute('lead_origem_id');
        parent::addAttribute('nome');
        parent::addAttribute('telefone');
        parent::addAttribute('email');
        parent::addAttribute('cep');
        parent::addAttribute('jsondados');
        parent::addAttribute('verificado');
        parent::addAttribute('url_img');
        parent::addAttribute('cidade');
        parent::addAttribute('estado');
        parent::addAttribute('atualizado_em');
        parent::addAttribute('cadastrado_em');
        parent::addAttribute('deletado_em');
        parent::addAttribute('deletado_por');
        parent::addAttribute('repique_em');
        parent::addAttribute('retorno_repique');
        parent::addAttribute('envio_manual');

    }

    /**
     * Method set_lead_status
     * Sample of usage: $var->lead_status = $object;
     * @param $object Instance of LeadStatus
     */
    public function set_lead_status(LeadStatus $object)
    {
        $this->lead_status = $object;
        $this->lead_status_id = $object->id;
    }

    /**
     * Method get_lead_status
     * Sample of usage: $var->lead_status->attribute;
     * @returns LeadStatus instance
     */
    public function get_lead_status()
    {

        // loads the associated object
        if (empty($this->lead_status))
            $this->lead_status = new LeadStatus($this->lead_status_id);

        // returns the associated object
        return $this->lead_status;
    }
    /**
     * Method set_servico_contrato
     * Sample of usage: $var->servico_contrato = $object;
     * @param $object Instance of ServicoContrato
     */
    public function set_servico_contrato(ServicoContrato $object)
    {
        $this->servico_contrato = $object;
        $this->servico_contrato_id = $object->id;
    }

    /**
     * Method get_servico_contrato
     * Sample of usage: $var->servico_contrato->attribute;
     * @returns ServicoContrato instance
     */
    public function get_servico_contrato()
    {

        // loads the associated object
        if (empty($this->servico_contrato))
            $this->servico_contrato = new ServicoContrato($this->servico_contrato_id);

        // returns the associated object
        return $this->servico_contrato;
    }
    /**
     * Method set_lead_origem
     * Sample of usage: $var->lead_origem = $object;
     * @param $object Instance of LeadOrigem
     */
    public function set_lead_origem(LeadOrigem $object)
    {
        $this->lead_origem = $object;
        $this->lead_origem_id = $object->id;
    }

    /**
     * Method get_lead_origem
     * Sample of usage: $var->lead_origem->attribute;
     * @returns LeadOrigem instance
     */
    public function get_lead_origem()
    {

        // loads the associated object
        if (empty($this->lead_origem))
            $this->lead_origem = new LeadOrigem($this->lead_origem_id);

        // returns the associated object
        return $this->lead_origem;
    }
    /**
     * Method set_system_users
     * Sample of usage: $var->system_users = $object;
     * @param $object Instance of SystemUsers
     */
    public function set_fk_deletado_por(SystemUsers $object)
    {
        $this->fk_deletado_por = $object;
        $this->deletado_por = $object->id;
    }

    /**
     * Method get_fk_deletado_por
     * Sample of usage: $var->fk_deletado_por->attribute;
     * @returns SystemUsers instance
     */
    public function get_fk_deletado_por()
    {

        // loads the associated object
        if (empty($this->fk_deletado_por))
            $this->fk_deletado_por = new SystemUsers($this->deletado_por);

        // returns the associated object
        return $this->fk_deletado_por;
    }

    /**
     * Method getLeadEnvios
     */
    public function getLeadEnvios()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('lead_id', '=', $this->id));
        return LeadEnvio::getObjects( $criteria );
    }
    /**
     * Method getArquivoss
     */
    public function getArquivoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('lead_id', '=', $this->id));
        return Arquivos::getObjects( $criteria );
    }
    /**
     * Method getLeadRepiques
     */
    public function getLeadRepiques()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('leads_id', '=', $this->id));
        return LeadRepique::getObjects( $criteria );
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

        $values = LeadEnvio::where('lead_id', '=', $this->id)->getIndexedArray('usuario_id','{usuario->name}');
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

        $values = LeadEnvio::where('lead_id', '=', $this->id)->getIndexedArray('lead_id','{lead->nome}');
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

        $values = LeadEnvio::where('lead_id', '=', $this->id)->getIndexedArray('contrato_id','{contrato->loja_id}');
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

        $values = LeadEnvio::where('lead_id', '=', $this->id)->getIndexedArray('lead_envio_status_id','{lead_envio_status->id}');
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

        $values = LeadEnvio::where('lead_id', '=', $this->id)->getIndexedArray('etapa_negociacao_id','{etapa_negociacao->nome}');
        return implode(', ', $values);
    }

    public function set_arquivos_lead_to_string($arquivos_lead_to_string)
    {
        if(is_array($arquivos_lead_to_string))
        {
            $values = Leads::where('id', 'in', $arquivos_lead_to_string)->getIndexedArray('nome', 'nome');
            $this->arquivos_lead_to_string = implode(', ', $values);
        }
        else
        {
            $this->arquivos_lead_to_string = $arquivos_lead_to_string;
        }

        $this->vdata['arquivos_lead_to_string'] = $this->arquivos_lead_to_string;
    }

    public function get_arquivos_lead_to_string()
    {
        if(!empty($this->arquivos_lead_to_string))
        {
            return $this->arquivos_lead_to_string;
        }

        $values = Arquivos::where('lead_id', '=', $this->id)->getIndexedArray('lead_id','{lead->nome}');
        return implode(', ', $values);
    }

    public function set_lead_repique_leads_to_string($lead_repique_leads_to_string)
    {
        if(is_array($lead_repique_leads_to_string))
        {
            $values = Leads::where('id', 'in', $lead_repique_leads_to_string)->getIndexedArray('nome', 'nome');
            $this->lead_repique_leads_to_string = implode(', ', $values);
        }
        else
        {
            $this->lead_repique_leads_to_string = $lead_repique_leads_to_string;
        }

        $this->vdata['lead_repique_leads_to_string'] = $this->lead_repique_leads_to_string;
    }

    public function get_lead_repique_leads_to_string()
    {
        if(!empty($this->lead_repique_leads_to_string))
        {
            return $this->lead_repique_leads_to_string;
        }

        $values = LeadRepique::where('leads_id', '=', $this->id)->getIndexedArray('leads_id','{leads->nome}');
        return implode(', ', $values);
    }

     public function get_distancia()
    {

        TTransaction::open('database');

        $geoLead = CacheGeolocalizacao::where('cep', 'like', $this->cep)->first();

        $loja = Loja::where('usuario_id', '=', TSession::getValue('userid'))->first();

        TTransaction::close();

        if($geoLead)
        {
            $latitude1 = $geoLead->lat;
            $longitude1 = $geoLead->lng;

            $latitude2 = $loja->latitude;
            $longitude2 = $loja->longitude;

            $unit = 'kilometers';
            $theta = $longitude1 - $longitude2;
            $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
            $distance = acos($distance);
            $distance = rad2deg($distance);
            $distance = $distance * 60 * 1.1515;
            switch($unit)
            {
                case 'miles':
                break;

                case 'kilometers' :
                $distance = $distance * 1.609344;

            }

            return 'A ' .(round($distance,2)).' km de você';
        }

        return 'ERROR';

    }

    /**
     * Obtém o elemento de verificação (ícone de check) com base no status de verificação do objeto.
     *
     * @return TElement O elemento de verificação (ícone de check) formatado corretamente.
     */
    public function get_buscar_verificado()
    {
        // Obtém a data atual e a data de atualização do objeto
        $atualizado_em = new DateTime($this->atualizado_em);
        $data_atual = new DateTime();
        $diferenca = $data_atual->diff($atualizado_em);

        // Verifica se a diferença em dias é superior a 30
        if ($diferenca->days > 30) {
            // Obtém a cor com base no status de verificação
            $verificado = $this->verificado == 'T' ? 'green' : 'red';
            // Cria o elemento de verificação (ícone de check) com a cor apropriada
            return $this->createCheckIcon($verificado);
        }

        // Verifica o número de telefone usando o serviço WhatsappService
        $response = WhatsappService::verificarNumeroTelefone($this->telefone);

        // Atualiza o status de verificação do objeto Leads, se existir
        $onVerificar = Leads::find($this->id);
        if ($onVerificar) {
            $onVerificar->verificado = $response->exists === true ? 'T' : 'F';
            $onVerificar->store();
        }

        // Obtém a cor com base no status de verificação retornado pelo serviço
        $verificado = $response->exists === true ? 'green' : 'red';
        // Cria o elemento de verificação (ícone de check) com a cor apropriada
        return $this->createCheckIcon($verificado);
    }

    /**
     * Cria o elemento de verificação (ícone de check) com a cor especificada.
     *
     * @param string $color A cor do ícone de verificação ('green' ou 'red').
     * @return TElement O elemento de verificação (ícone de check) formatado corretamente.
     */
    private function createCheckIcon($color)
    {
        $iElement = new TElement('i');
        $iElement->class = 'fas fa-check-circle';
        $iElement->style = "color: $color;";
        return $iElement;
    }

    /**
     * Obtém a foto de perfil do usuário.
     * Verifica se a foto foi atualizada nos últimos 30 dias e retorna a imagem correspondente.
     * Se a foto não foi atualizada recentemente, consulta o serviço do Whatsapp para obter a foto de perfil.
     * Armazena a foto de perfil obtida no banco de dados para uso futuro.
     *
     * @return string A tag HTML da imagem de perfil.
     */
    public function get_foto_perfil()
    {
        $diferenca = (new DateTime())->diff(new DateTime($this->atualizado_em));

        if ($diferenca->days < 30) {
            return $this->createFoto($this->url_img);
        }

        $response = WhatsappService::obterFotoPerfil($this->telefone);

        $onVerificar = Leads::find($this->id);
        if ($onVerificar) {
            $onVerificar->url_img = $response->link;
            $onVerificar->store();
        }

        return $this->createFoto($response->link);
    }

    /**
     * Cria a tag HTML da foto de perfil com base no link fornecido.
     *
     * @param string|null $link O link da foto de perfil (opcional).
     * @return string A tag HTML da imagem de perfil.
     */
    private function createFoto($link)
    {
        if ($link && $link !== 'null') {
            return '<img src="' . $link . '" alt="Imagem" style="border-radius: 50%; width: 50px; height: 50px;">';
        }

        return '<img src="app/images/photos/sem-imagem.png" alt="Imagem" style="border-radius: 50%; width: 50px; height: 50px;">';
    }

    public function get_envios_count()
    {
        $date = date('Y-m-d', strtotime('-30 days'));
        $valor = $this->id;
         //CONTA OS ENVIOS USANDO O CRITERIA E O VALOR DE $date
        $criteria = new TCriteria;
        $criteria->add(new TFilter('lead_id', '=', $valor));
        $criteria->add(new TFilter('cadastrado_em', '>=', $date));

        $count = LeadEnvio::countObjects($criteria);

        return $count;
    }

    public function atualizaFoto()
    {
        // Data atual
        $dataAtual = new DateTime();

        // Data da última atualização
        $dataUltimaAtualizacao = new DateTime($this->lead->atualizado_em);

        // Calcula a diferença entre as datas
        $intervalo = $dataAtual->diff($dataUltimaAtualizacao);

        // Verifica se passaram 15 dias
        if ($intervalo->days > 15) {

            $responseFoto = WhatsappService::obterFotoPerfil($this->lead->telefone);
            if ($responseFoto && $responseFoto->link !== 'null') {
                $this->url_img      = $responseFoto->link;
            }
        }
    }


}
