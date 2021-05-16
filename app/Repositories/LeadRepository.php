<?php

namespace App\Repositories;

use App\Models\Lead;
use Exception;
use Illuminate\Support\Facades\Cookie;

/**
 * Class LeadRepository
 * @package App\Repositories
 */
class LeadRepository
{
    /**
     * Nome do cookie responsável por armazenar o identificador
     */
    const COOKIE = "identifier_cookie";
    /**
     * @var Lead
     */
    private $model;
    /**
     * @var int
     */
    private $identifier;

    /**
     * LeadRepository constructor.
     * @param Lead $model
     */
    public function __construct(Lead $model)
    {
        $this->model = $model;
    }

    /**
     * @return void
     */
    public function setIdentifier(): void
    {
        if (!$this->identifier) {
            $this->identifier = Cookie::get(self::COOKIE);
        }
    }

    /**
     * @return Lead|null
     */
    public function getLeadByIdentifier(): ?Lead
    {
        return Lead::where("identifier", $this->identifier)->first();
    }

    /**
     * @param array $data
     * @return Lead|null
     * @throws Exception
     */
    public function createOrUpdate(array $data): ?Lead
    {
        try {
            $this->setIdentifier();
            $lead = $this->getLeadByIdentifier();
            if ($lead) {
                $this->model = $lead;
            }

            $data["identifier"] = $this->identifier;
            $this->model->fill($data);
            $this->model->save();

            return $this->model;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
