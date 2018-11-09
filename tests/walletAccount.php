<?php

require_once(__DIR__.'/../vendor/autoload.php');

use Ontio\SDK\Wallet\Account;
use Ontio\SDK\Wallet\Scrypt;
use Ontio\SDK\Wallet\Control;
use Ontio\SDK\Wallet\Wallet;
use Ontio\SDK\Wallet\Identity;
use Ontio\SDK\Manager\WalletMgr;

$account = new Account();
//$scrypt = new Scrypt();
//$control = new Control();
$identity = new Identity();
$wallet = new Wallet();
//
$account->setAddress(md5(random_bytes(32)));
$identity->ontid = md5(random_bytes(32));
//

//var_dump($account->toString());
//var_dump($scrypt->toString());
//var_dump($control->toString());

//$wallet->setDefaultIdentity(-1);

$walletMgr = new WalletMgr("wallet.json", new \Ontio\Crypto\SignatureSchema());
//
//$wallet = $walletMgr->getWallet();
//$wallet->addIdentity($identity);
//



$wallet =  $walletMgr->getWallet();

$wallet->addAccount($account);
$wallet->addIdentity($identity);

$walletMgr->writeWallet();


