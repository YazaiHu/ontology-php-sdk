<?php

namespace Ontio\SDK\Wallet;

class Control
{
    private $id = "";
    private $label = "";
    private $address = "";
    private $isDefault = false;
    private $lock = false;
    private $algorithm = "ECDSA";
    private $parameters = [];
    private $key = "";
    private $encAlg = "aes-256-gcm";
    private $salt = "";
    private $hash = "sha256";
    private $publicKey = "";

    public function __construct(string $key = '', string $id = '', string $publicKey = '')
    {
        $this->key = $key;
        $this->id = $id;
        $this->publicKey = $publicKey;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getEncAlg(): string
    {
        return $this->encAlg;
    }

    /**
     * @param string $encAlg
     */
    public function setEncAlg(string $encAlg)
    {
        $this->encAlg = $encAlg;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt(string $salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @param string $publicKey
     */
    public function setPublicKey(string $publicKey)
    {
        $this->publicKey = $publicKey;
    }

    public function toString(): string
    {
        return str_replace('encAlg', 'enc-alg', Common::toJsonString($this));

    }

    public function __toString()
    {
        return $this->toString();
    }
}