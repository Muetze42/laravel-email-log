<?php

namespace NormanHuth\LaravelEmailLog\Traits;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * @property int $id
 * @property string $subject
 * @property string $body
 * @property array $from
 * @property array $to
 * @property array $bbc
 * @property array $cc
 * @property array $reply_to
 * @property array $headers
 * @property array $attachments
 * @property bool $is_html
 * @property int $priority
 * @property string|null $authenticatable_type
 * @property int|null $authenticatable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 */
trait LaravelNovaTrait
{
    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function logFields(NovaRequest $request): array
    {
        return [
            // Subject
            Text::make(__('Subject'), 'subject')
                ->exceptOnForms(),

            // From
            Text::make(__('From'), 'from', function () {
                return $this->formatArrayForIndex($this->from);
            })->onlyOnIndex(),
            Text::make(__('From'), 'from', function () {
                return $this->formatArrayForDetail($this->from);
            })->onlyOnDetail()->asHtml(),

            // To
            Text::make(__('To'), 'to', function () {
                return $this->formatArrayForIndex($this->to);
            })->onlyOnIndex(),
            Text::make(__('To'), 'to', function () {
                return $this->formatArrayForDetail($this->to);
            })->onlyOnDetail()->asHtml(),

            // bbc
            Text::make(__('BBC'), 'bbc', function () {
                return $this->formatArrayForDetail($this->bbc);
            })->onlyOnDetail()->asHtml(),

            // cc
            Text::make(__('CC'), 'cc', function () {
                return $this->formatArrayForDetail($this->bbc);
            })->onlyOnDetail()->asHtml(),

            // reply to
            Text::make(__('Reply to'), 'reply_to', function () {
                return $this->formatArrayForDetail($this->reply_to);
            })->onlyOnDetail()->asHtml(),

            // reply to
            Text::make(__('Reply to'), 'reply_to', function () {
                return $this->formatArrayForDetail($this->reply_to);
            })->onlyOnDetail()->asHtml(),

            // headers
            KeyValue::make(__('Headers'), 'headers')
                ->rules('json')->onlyOnDetail(),

            // headers
            KeyValue::make(__('Attachments'), 'attachments')
                ->rules('json')->onlyOnDetail(),

            // priority
            Number::make(__('Priority'), 'priority')
                ->onlyOnDetail(),

            // body
            Textarea::make(__('Body'), 'body')
                ->onlyOnDetail()->alwaysShow()
                ->canSee(function () {
                    return !$this->is_html;
                }),
            Markdown::make(__('Body'), 'body')
                ->onlyOnDetail()->alwaysShow()
                ->canSee(function () {
                    return $this->is_html;
                }),

            // authenticatable
            MorphTo::make(__('Author'), 'authenticatable'),
        ];
    }

    protected function formatArrayForDetail(?array $data): string
    {
        $data = array_map('e', (array) $data);

        return implode('<br>', $data);
    }

    /**
     * @param array|null $data
     *
     * @return string
     */
    protected function formatArrayForIndex(?array $data): string
    {
        $data = (array) $data;

        $return = $data[0] ?? '';

        return count($data) > 1 ? $return . ' ...' : $return;
    }
}
