<?php

namespace Search;

class Identity
{
    private $eff_contact_id;
    private $role;
    private $account_id;
    private $network_ids;

    public function __construct(string $eff_contact_id, string $role, string $account_id, array $network_ids)
    {
        $this->eff_contact_id = $eff_contact_id;
        $this->role           = $role;
        $this->account_id     = $account_id;
        $this->network_ids    = $network_ids;
    }

    public function getEffectiveContactId(): string
    {
        return $this->eff_contact_id;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getAccountId(): string
    {
        return $this->account_id;
    }

    public function getNetworkIds(): array
    {
        return $this->network_ids;
    }
}