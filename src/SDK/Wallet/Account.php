<?php

namespace Ontio\SDK\Wallet;

use Ontio\Common\Common;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Account
{
    public $label = "";
    public $address = "";
    public $isDefault = false;
    public $lock = false;
    public $algorithm = "";
    public $parameters = [];
    public $key = "";
    public $encAlg = "aes-256-gcm";
    public $salt = "";
    public $hash = "sha256";
    public $publicKey = "";
    public $signatureScheme = "SHA256WithECDSA";
    public $extra = null;

    /**
     * @param string|null $alg
     * @param array|null $params
     * @param string|null $encAlg
     * @param string|null $schema
     * @param string|null $hash
     */
    public function __constructor(string $alg = null, array $params = null, string $encAlg = null, string $schema = null, string $hash = null) {
        $this->algorithm = $alg ?? $this->algorithm;
        $this->signatureScheme = $schema ?? $this->signatureScheme;
        $this->encAlg = $encAlg ?? $this->encAlg;
        $this->hash = $hash ?? $this->hash;
        $this->extra = null;

        $this->parameters['curve'] = $params[0];
    }

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress(string $address) {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @param string $label
     * @return $this
     */
    public function setLabel(string $label) {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @param bool $default
     */
    public function setDefault(bool $default) {
        $this->isDefault = $default;
    }

    /**
     * @return bool
     */
    public function getDefault() {
        return $this->isDefault;
    }

    /**
     * @return null
     */
    public function getExtra() {
        return $this->extra;
    }

    /**
     * @param $extra
     * @return $this
     */
    public function setExtra($extra) {
        $this->extra = $extra;

        return $this;
    }

    /**
     * @return string
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * @param strring $key
     */
    public function setKey(strring $key) {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getEncAlg() {
        return $this->encAlg;
    }

    /**
     * @param string $encAlg
     * @return $this
     */
    public function setEncAlg(string $encAlg) {
        $this->encAlg = $encAlg;

        return $this;
    }

    /**
     * @return string
     */
    public function getHash() {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return $this
     */
    public function setHash(string $hash) {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @param string $salt
     * @return $this
     */
    public function setSalt(string $salt) {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublicKey() {
        return $this->publicKey;
    }

    /**
     * @param string $publicKey
     * @return $this
     */
    public function setPublicKey(string $publicKey) {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * @return string
     */
    public function toString() {
        return Common::toJsonString($this);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
}
