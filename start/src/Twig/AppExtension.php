<?php

namespace App\Twig;

use App\Service\MarkdownHelper;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension implements ServiceSubscriberInterface
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('cached_markdown', [$this, 'processMarkdown'],['is_safe'=> ['html']]), //doSomething e metoda care se va apela cand
                                                                            //userul apasa pe cached_markdown
        ];
    }

    public function processMarkdown($value)
    {
        return $this->container
                ->get(MarkdownHelper::class)
                ->parse($value);
    }

    public static function getSubscribedServices()
    {
       return [
            MarkdownHelper::class
       ];
    }

// ce se intampla aici , avand interfata ServiceSubscriberInterface, si un constructor care are ca parametru un container
// contrusctorul va lua valoare din container in cazul de fata metoda getSubscribedServices si va pune markdown in acel container
}
