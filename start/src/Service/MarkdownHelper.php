<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 10/26/2018
 * Time: 11:23 AM
 */

namespace App\Service;


use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{   private $cache;

    private $markdown;

    private $markdownLogger;

    public function __construct(AdapterInterface $cache , MarkdownInterface $markdown,LoggerInterface $markdownLogger)
    {
        $this->cache=$cache;
        $this->markdown=$markdown;
        $this->markdownLogger = $markdownLogger;
    }

    public function parse(string $source): string
    {
        if(stripos($source, 'bacon') !== false){
            $this->markdownLogger->info("They are talking about bacon");
        }

        $item = $this->cache->getItem('markdown_'.md5($source));
        if(!$item->isHit()){
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }

        return  $item->get();
    }
}