<?php

namespace BabDev\ServerPushManager\Http;

use Psr\Link\LinkInterface;

/**
 * Serializes a list of Link instances to a HTTP Link header.
 *
 * This class is based on `Symfony\Component\WebLink\HttpHeaderSerializer`
 *
 * @internal
 */
final class HeaderSerializer
{
    /**
     * Builds the value of the "Link" HTTP header.
     *
     * @param iterable<LinkInterface> $links
     */
    public function serialize(iterable $links): ?string
    {
        $elements = [];

        foreach ($links as $link) {
            if ($link->isTemplated()) {
                continue;
            }

            $attributes = ['', sprintf('rel="%s"', implode(' ', $link->getRels()))];

            foreach ($link->getAttributes() as $key => $value) {
                if (\is_array($value)) {
                    foreach ($value as $v) {
                        $attributes[] = sprintf('%s="%s"', $key, $v);
                    }

                    continue;
                }

                if (!\is_bool($value)) {
                    $attributes[] = sprintf('%s="%s"', $key, $value);

                    continue;
                }

                if ($value === true) {
                    $attributes[] = $key;
                }
            }

            $elements[] = sprintf('<%s>%s', $link->getHref(), implode('; ', $attributes));
        }

        return $elements ? implode(',', $elements) : null;
    }
}
