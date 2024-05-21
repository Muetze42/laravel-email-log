<?php

namespace NormanHuth\LaravelEmailLog\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Part\DataPart;

class LogSentMessage implements ShouldQueue
{
    /**
     * Get the name of the listener's queue connection.
     */
    public function viaConnection(): string
    {
        return config('email-log.queue_connection');
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        $message = $event->message;
        $log = app(config('email-log.model'))->create([
            'subject' => $message->getSubject(),
            'body' => $message->getTextBody(),
            'from' => $this->parseAddresses($message->getFrom()),
            'to' => $this->parseAddresses($message->getTo()),
            'bbc' => $this->parseAddresses($message->getBcc()),
            'cc' => $this->parseAddresses($message->getCc()),
            'reply_to' => $this->parseAddresses($message->getReplyTo()),
            'headers' => $message->getHeaders()->toArray(),
            'attachments' => $this->parseAttachments($message->getAttachments()),
            'is_html' => !is_null($message->getHtmlBody()),
            'priority' => $message->getPriority(),
        ]);

        $request = request();
        if ($request && $user = $request->user()) {
            $log->authenticatable()->associate($user)->save();
        }
    }

    /**
     * @param  \Symfony\Component\Mime\Address[]|null  $addresses
     *
     */
    protected function parseAddresses(?array $addresses): array
    {
        return array_map(
            fn (Address $address) => $address->toString(),
            (array) $addresses
        );
    }

    /**
     * @param  \Symfony\Component\Mime\Part\DataPart[]|null  $attachments
     *
     */
    protected function parseAttachments(?array $attachments): array
    {
        return array_map(
            fn (DataPart $attachment) => $attachment->asDebugString(),
            (array) $attachments
        );
    }
}
