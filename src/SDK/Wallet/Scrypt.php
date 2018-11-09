<?php

namespace Ontio\SDK\Wallet;

class Scrypt
{
    private $n = 16384;
    private $r = 8;
    private $p = 8;
    private $DkLen = 64;
    private $Salt;

    public function __construct(int $n = 16384, int $r = 8, int $p = 8) {
        $this->n = $n;
        $this->r = $r;
        $this->p = $p;
    }

    /**
     * @return int
     */
    public function getN(): int
    {
        return $this->n;
    }

    /**
     * @param int $n
     */
    public function setN(int $n)
    {
        $this->n = $n;
    }

    /**
     * @return int
     */
    public function getR(): int
    {
        return $this->r;
    }

    /**
     * @param int $r
     */
    public function setR(int $r)
    {
        $this->r = $r;
    }

    /**
     * @return int
     */
    public function getP(): int
    {
        return $this->p;
    }

    /**
     * @param int $p
     */
    public function setP(int $p)
    {
        $this->p = $p;
    }

    public function toString(): string
    {
        $pairs = [];

        foreach ($this as $key => $val) {
            $pairs[$key] = $val;
        }

        return json_encode($pairs);
    }

    public function __toString()
    {
        return $this->toString();
    }
}