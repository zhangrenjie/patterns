<?php

namespace DesignPatterns\Behavioral\ChainOfResponsibilities;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class handler
{
    private $successor = null;//继任者

    public function __construct(Handle $handle = null)
    {
        $this->successor = $handle;
    }

    final public function handle(RequestInterface $request)
    {
        $processed = $this->processing($request);
        if ($processed === null) {
            if ($this->successor !== null) {
                $processed = $this->successor->handle($request);
            }
        }
    }

    //
    abstract public function processing(RequestInterface $request);


}