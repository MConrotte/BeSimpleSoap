<?php

/*
 * This file is part of the BeSimpleSoapCommon.
 *
 * (c) Christian Kerl <christian-kerl@web.de>
 * (c) Francis Besset <francis.besset@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace BeSimple\SoapCommon\Converter;

use BeSimple\SoapBundle\Soap\SoapRequest;

/**
 * @author Christian Kerl <christian-kerl@web.de>
 */
class DateTimeTypeConverter implements TypeConverterInterface
{
    public function getTypeNamespace()
    {
        return 'http://www.w3.org/2001/XMLSchema';
    }

    public function getTypeName()
    {
        return 'dateTime';
    }

    public function convertXmlToPhp($data, SoapRequest $request = null)
    {
        $doc = new \DOMDocument();
        $doc->loadXML($data);

        if ('' === $doc->textContent) {
            return null;
        }

        return new \DateTime($doc->textContent);
    }

    public function convertPhpToXml($data)
    {
        return sprintf('<%1$s>%2$s</%1$s>', $this->getTypeName(), $data->format('Y-m-d\TH:i:sP'));
    }
}

