<?php

declare(strict_types=1);

namespace MarvelousMartin\LaravelLatte;

use Latte\Extension as LatteExtension;

class Extension extends LatteExtension
{
    public function getTags(): array
    {
        return [
            'link' => [Nodes\LinkNode::class, 'create'],
            'asset' => [Nodes\AssetNode::class, 'create'],
        ];
    }
}
