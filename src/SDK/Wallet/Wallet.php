<?php

namespace Ontio\SDK\Wallet;

use Ontio\Common\Common;

class Wallet
{
    private $name = "com.github.ontio";
    private $version = "1.0";
    private $createTime = "";
    private $defaultOntid = "";
    private $defaultAccountAddress = "";
    private $scrypt = null;
    private $extra = [];
    private $identities = [];
    private $accounts = [];

    public function __construct()
    {
        $this->identities = [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    /**
     * @param string $createTime
     */
    public function setCreateTime(string $createTime)
    {
        $this->createTime = $createTime;
    }

    /**
     * @return string
     */
    public function getDefaultOntid(): string
    {
        return $this->defaultOntid;
    }

    /**
     * @param string $defaultOntid
     */
    public function setDefaultOntid(string $defaultOntid)
    {
        $this->defaultOntid = $defaultOntid;
    }

    /**
     * @return string
     */
    public function getDefaultAccountAddress(): string
    {
        return $this->defaultAccountAddress;
    }

    /**
     * @param string $defaultAccountAddress
     */
    public function setDefaultAccountAddress(string $defaultAccountAddress)
    {
        $this->defaultAccountAddress = $defaultAccountAddress;
    }

    /**
     * @return null
     */
    public function getScrypt()
    {
        return $this->scrypt;
    }

    /**
     * @param null $scrypt
     */
    public function setScrypt($scrypt)
    {
        $this->scrypt = $scrypt;
    }

    /**
     * @return array
     */
    public function getExtra(): array
    {
        return $this->extra;
    }

    /**
     * @param array $extra
     */
    public function setExtra(array $extra)
    {
        $this->extra = $extra;
    }

    /**
     * @return array
     */
    public function getIdentities(): array
    {
        return $this->identities;
    }

    /**
     * @param array $identities
     */
    public function setIdentities(array $identities)
    {
        $this->identities = $identities;
    }

    /**
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * @param array $accounts
     */
    public function setAccounts(array $accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @param string $ddress
     * @return mixed|null
     */
    public function getAccount(string $ddress)
    {
        foreach ($this->accounts as $_account) {
            if ($ddress === $_account->getAddress()) {
                return $_account;
            }
        }

        return null;
    }

    /**
     * @param Account $account
     * @return bool
     */
    public function addAccount(Account $account)
    {
        foreach ($this->accounts as $_account) {
            if ($account->getAddress() === $_account->getAddress()) {
                return true;
            }
        }

        array_push($this->accounts, $account);

        if (count($this->accounts) === 1) {
            $this->setDefaultAccount(0);
        }

        return true;
    }

    /**
     * @param string $address
     * @return bool
     */
    public function removeAccount(string $address)
    {
        foreach ($this->accounts as $key => $_account) {
            if ($address === $_account->getAddress()) {
                array_splice($this->accounts, $key, 1);
                return true;
            }
        }

        return false;
    }

    /**
     * Clear accounts
     */
    public function learAccounts()
    {
        $this->accounts = [];
    }

    /**
     * @param Identity $identity
     * @return bool
     */
    public function addIdentity(Identity $identity)
    {
        if ($identity->ontid == null) {
            return false;
        }


        foreach ($this->identities as $_identity) {
            if ($identity->ontid === $_identity->ontid) {
                return true;
            }
        }


        array_push($this->identities, $identity);

        if (count($this->identities) === 1) {
            $this->setDefaultIdentity(0);
            $this->defaultOntid = $identity->ontid;
        }

        return true;
    }

    /**
     * @param string $ontid
     * @return mixed|null
     */
    public function getIdentity(string $ontid)
    {
        foreach ($this->identities as $_identity) {
            if ($_identity->ontid === $ontid) {
                return $_identity;
            }
        }

        return null;
    }

    /**
     * @param string $ontid
     * @return bool
     */
    public function removeIdentity(string $ontid): bool
    {
        foreach ($this->identities as $key => $_identity) {
            if ($ontid === $_identity->ontid) {
                array_splice($this->identities, $key, 1);
                return true;
            }
        }

        return false;
    }

    /**
     * @param $key
     * @return bool
     */
    public function setDefaultAccount($key): bool
    {
        $hit = false;
        $default = null;

        /**
         * If the $key is address
         */
        if (is_string($key)) {

            /**
             * @var Account $account
             */
            foreach ($this->accounts as $account) {

                if ($account->getDefault()) {
                    $default = $account;
                }

                if ($account->getAddress() === $key) {
                    $this->defaultAccountAddress = $key;
                    $account->setDefault(true);
                    $hit = true;
                }
            }

            /**
             * Make the original default be not default
             */
            foreach ($this->accounts as $account) {

                if (!$hit) {
                    break;
                }

                if ($default->getAddress() !== $key) {
                    $default->setDefault(false);
                }
            }
        }

        /**
         * If the $key is index
         */
        if (is_int($key)) {

            if (count($this->accounts) - 1 < $key || $key < 0) {
                return false;
            }

            $hit = true;

            /**
             * @var Account $account
             */
            foreach ($this->accounts as $account) {
                $account->setDefault(false);
            }

            $this->accounts[$key]->setDefault(true);
            $this->defaultAccountAddress = $this->accounts[$key]->getAddress();
        }

        return true;
    }

    /**
     * @Ignore
     * @return Account
     */
    public function getDefaultAccount(): Account
    {
        return $this->getAccount($this->defaultAccountAddress);
    }

    /**
     * @param $key
     * @return bool
     */
    public function setDefaultIdentity($key): bool
    {
        $hit = false;
        $default = null;

        /**
         * The $key is ontid
         */
        if (is_string($key)) {

            /**
             * @var Identity $identity
             */
            foreach ($this->identities as $identity) {

                if ($identity->isDefault) {
                    $default = $identity;
                }

                if ($identity->ontid === $key && !$identity->isDefault) {
                    $hit = true;
                    $identity->isDefault = true;
                }
            }

            /**
             * @var Identity $identity
             */
            foreach ($this->identities as $identity) {
                if (!$hit) {
                    break;
                }

                if ($identity->ontid === $key) {
                    continue;
                }

                $identity->isDefault = false;
            }
        }

        /**
         * The $key is index
         */
        if (is_int($key)) {
            if ((count($this->identities) < $key - 1) || $key < 0) {
                return false;
            }

            /**
             * @var Identity $identity
             */
            foreach ($this->identities as $identity) {
                $identity->isDefault = false;
            }

            $this->identities[$key]->isDefault = true;
            $this->defaultOntid = $this->identities[$key]->ontid;
        }

        return $hit;
    }

    /**
     * @return Identity
     */
    public function getDefaultIdentity()
    {
        return $this->getIdentity($this->defaultOntid);
    }

    /**
     * @return string
     */
    public function toString()
    {
        $ignoredFields = ['defaultAccount', 'defaultIdentity', 'createTime'];

        if (count($this->identities) === 0) {
            array_push($ignoredFields, 'identities', 'defaultOntid');
        }

        return Common::toJsonString($this, $ignoredFields);
    }


    public function __toString()
    {
        return $this->toString();
    }
}