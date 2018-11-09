<?php

namespace Ontio\SDK\Manager;


use Ontio\Common\Common;
use Ontio\Crypto\SignatureSchema;
use Ontio\SDK\Wallet\Wallet;
use PHPUnit\Runner\Exception;

class WalletMgr
{
    private $walletInMem;
    private $walletFile;

    /* signatureSchema */
    private $schema = null;

    private $filePath;

    public function __construct(string $wallet, SignatureSchema $schema)
    {
        $this->schema = $schema;
        $this->openWallet($wallet);
    }

    public function openWallet(string $wallet)
    {
        $this->filePath = $wallet;

        if (!is_file($wallet) || !file_exists($wallet)) {
            $this->walletInMem = $this->walletInMem ?? new Wallet();
            $this->walletFile = $this->walletInMem ?? new Wallet();

            $this->walletInMem->setCreateTime((new \DateTime())->format("Y-M-D'T'h:mm:ss'Z'"));

            $this->writeWallet();
        }

        $walletContent = file_get_contents($wallet);
        $this->walletInMem = Common::fromJsonString($walletContent, Wallet::class);
    }

    /**
     * @return Wallet
     */
    public function getWallet(): Wallet
    {
        return $this->walletInMem;
    }

    public function writeWallet()
    {
        file_put_contents($this->filePath, $this->walletInMem);
    }

}