<?php

namespace Ontio\SDK\Manager;


use Ontio\Common\Common;
use Ontio\Crypto\SignatureSchema;
use Ontio\SDK\Wallet\Wallet;

class WalletMgr
{
    private $walletInMem;
    private $walletFile;

    /* signatureSchema */
    private $schema = null;

    private $filePath;

    public function __construct($wallet, SignatureSchema $schema)
    {
        $this->schema = $schema;

        if ($wallet instanceof Wallet) {
            $this->walletFile = $wallet;
            $this->walletInMem = $wallet;

            return true;
        } elseif (is_string($wallet)) {

            $this->filePath = $wallet;

            if (!is_file($wallet) || !file_exists($wallet)) {
                $this->walletInMem = new Wallet();
                $this->walletFile = new Wallet();

                $this->walletInMem->setCreateTime((new \DateTime())->format("Y-M-D'T'h:mm:ss'Z'"));

                $this->writeWallet();
            }

            $walletContent = file_get_contents($wallet);

            $this->walletInMem = Common::fromJsonString($walletContent, Wallet::class);

            echo $this->walletInMem . "\n";

            return true;
        }

        return false;
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
        file_put_contents($this->filePath, $this->walletInMem->toString());
    }

}