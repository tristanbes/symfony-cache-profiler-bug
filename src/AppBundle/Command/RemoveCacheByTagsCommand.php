<?php

namespace AppBundle\Command;

use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\Cache\Exception\InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveCacheByTagsCommand extends Command
{
    private $cache;

    public function __construct(TagAwareAdapter $cache)
    {
        $this->cache = $cache;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('test:clear:tags');
        $this->addArgument('tags', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'list of the tags separated by space you want to remove');
        $this->setHelp(<<<HERE
Removes the cache for specific given tags

    $ bin/console test:clear:tags tag1 tag2 tag3

HERE
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tags = $input->getArgument('tags');

        try {
            $output->writeln(sprintf('<error>%s</error>', implode(', ', $tags)));
            $success = $this->cache->invalidateTags($tags);
        } catch (InvalidArgumentException $exception) {
            $output->writeln(sprintf('<error>Problem with the given tags (Error: %s)</error>'), $exception->getMessage());
        }

        if ($success === true) {
            $output->writeln('<info>Le cache associé aux tags fournis ont été supprimés</info>');
        } else {
            $output->writeln('<error>Le cache n\'à pas été totallement ou partiellement vidé</error>');
        }
    }
}
