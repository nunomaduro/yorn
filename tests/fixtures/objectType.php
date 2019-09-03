<?php 

namespace Tests\Fixtures;

final class ObjectType 
{
     /**
     * @var string
     */
    public $message = 'hello';

    public function __construct(string $bar) 
    {
        $this->message .= ' ' . $bar;
    }

    public function getMessage(): string 
    {
        return $this->message;
    }
}

export(ObjectType::class);