<?php


/**
 * Description of Common
 *
 * @author renshan
 */

namespace Ontio\Common;

use Mdanter\Ecc\EccFactory;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class Common {

    const didont = "did:ont";
    const MULTI_SIG_MAX_PUBKEY_SIZE = 16;
    const TX_MAX_SIG_SIZE = 16;

    public static function generateKey64Bit() {
        $generator = EccFactory::getNistCurves()->generator384();
        $private = $generator->createPrivateKey();

        var_dump($private);
    }

    /**
     * @param $obj
     * @param array $ignoredAttributes
     * @return mixed
     */
    public static function toJsonString($obj, $ignoredAttributes = []) {
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes($ignoredAttributes);
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);

        return str_replace('encAlg', 'enc-alg', $serializer->serialize($obj, 'json'));
    }


    /**
     * @param string $json
     * @param string $class
     * @return null|object
     */
    public static function fromJsonString(string $json, string $class)
    {
        if (!class_exists($class)) {
            return null;
        }

        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);

        return $serializer->deserialize($json, $class, 'json');
    }
}
