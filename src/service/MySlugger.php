<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;

class MySlugger
{
    /**
     * Symfony's slugger
     */
    private $slugger;

    private $toLower;

    public function __construct(SluggerInterface $slugger, bool $toLower)
    {
        $this->slugger = $slugger;
        $this->toLower = $toLower;
    }

    /**
     * "Slugifie" string
     * 
     * @param string 
     * @return string
     */
    public function slugify(string $stringToSlug): string
    {
        if ($this->toLower === true) {
            return $this->slugger->slug($stringToSlug)->lower();
        } else {
            return $this->slugger->slug($stringToSlug);
        }
    }
}