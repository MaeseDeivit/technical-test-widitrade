<?php

namespace Src\Shared\Infrastructure\Bus;

use Src\Shared\Domain\Bus\Command\Command;
use Symfony\Component\Messenger\MessageBus;
use Src\Shared\Domain\Bus\Command\CommandBus;
use Src\Shared\Infrastructure\Bus\CommandNotRegistered;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Src\Shared\Infrastructure\Bus\CallableFirstParameterExtractor;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;

class CommandBusImp implements CommandBus
{
    private MessageBus $bus;

    public function __construct(iterable $commandHandlers)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator(CallableFirstParameterExtractor::forCallables($commandHandlers))
                ),
            ]
        );
    }

    /**
     * @throws Throwable
     * @throws CommandNotRegistered
     */
    public function dispatch(Command $command): void
    {
        try {
            $this->bus->dispatch($command);
        } catch (NoHandlerForMessageException) {
            throw new CommandNotRegistered("Command " . get_class($command) .  " not registered.");
        } catch (HandlerFailedException $error) {
            throw $error->getPrevious() ?? $error;
        }
    }
}
