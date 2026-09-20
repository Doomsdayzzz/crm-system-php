<?php

namespace App\Enums;

enum ApplicationStatusEnum: int
{
    case NEW = 1;
    case ASSIGNED = 2;
    case IN_PROGRESS = 3;
    case QUALIFIED = 4;
    case REJECTED = 5;
    case DUPLICATE = 6;
    case SPAM = 7;
    case CLOSED = 8;

    /**
     * Получить человекочитаемое название статуса
     */
    public function label(): string
    {
        return match ($this) {
            self::NEW => 'Новая',
            self::ASSIGNED => 'Назначена',
            self::IN_PROGRESS => 'В обработке',
            self::QUALIFIED => 'Квалифицирована',
            self::REJECTED => 'Отклонена',
            self::DUPLICATE => 'Дубликат',
            self::SPAM => 'Спам',
            self::CLOSED => 'Закрыта',
        };
    }

    /**
     * Получить цвет статуса для UI
     */
    public function color(): string
    {
        return match ($this) {
            self::NEW => 'blue',
            self::ASSIGNED => 'indigo',
            self::IN_PROGRESS => 'yellow',
            self::QUALIFIED => 'green',
            self::REJECTED => 'red',
            self::DUPLICATE => 'gray',
            self::SPAM => 'red',
            self::CLOSED => 'gray',
        };
    }

    /**
     * Получить иконку статуса
     */
    public function icon(): string
    {
        return match ($this) {
            self::NEW => 'fa-inbox',
            self::ASSIGNED => 'fa-user-check',
            self::IN_PROGRESS => 'fa-spinner',
            self::QUALIFIED => 'fa-check-circle',
            self::REJECTED => 'fa-times-circle',
            self::DUPLICATE => 'fa-clone',
            self::SPAM => 'fa-ban',
            self::CLOSED => 'fa-check-double',
        };
    }

    /**
     * Получить CSS класс для статуса
     */
    public function cssClass(): string
    {
        return match ($this) {
            self::NEW => 'status-new',
            self::ASSIGNED => 'status-assigned',
            self::IN_PROGRESS => 'status-in-progress',
            self::QUALIFIED => 'status-qualified',
            self::REJECTED => 'status-rejected',
            self::DUPLICATE => 'status-duplicate',
            self::SPAM => 'status-spam',
            self::CLOSED => 'status-closed',
        };
    }

    /**
     * Проверить, является ли статус финальным
     */
    public function isFinal(): bool
    {
        return in_array($this, [
            self::QUALIFIED,
            self::REJECTED,
            self::DUPLICATE,
            self::SPAM,
            self::CLOSED
        ]);
    }

    /**
     * Проверить, можно ли перейти в этот статус
     */
    public function canTransitionFrom(self $from): bool
    {
        return match ($from) {
            self::NEW => in_array($this, [
                self::ASSIGNED,
                self::REJECTED,
                self::SPAM
            ]),
            self::ASSIGNED => in_array($this, [
                self::IN_PROGRESS,
                self::REJECTED,
                self::DUPLICATE
            ]),
            self::IN_PROGRESS => in_array($this, [
                self::QUALIFIED,
                self::REJECTED,
                self::DUPLICATE,
                self::SPAM
            ]),
            self::QUALIFIED => in_array($this, [
                self::CLOSED
            ]),
            self::REJECTED => in_array($this, [
                self::NEW
            ]),
            self::DUPLICATE => in_array($this, [
                self::NEW
            ]),
            self::SPAM => in_array($this, [
                self::NEW
            ]),
            self::CLOSED => in_array($this, [
                self::NEW
            ]),
        };
    }

    /**
     * Получить все статусы для выпадающего списка
     */
    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($case) => [
            $case->value => $case->label()
        ])->toArray();
    }

    /**
     * Получить статусы для фильтрации
     */
    public static function filterOptions(): array
    {
        return [
            'all' => 'Все статусы',
            ...self::options()
        ];
    }

    /**
     * Статусы, доступные для назначения менеджером
     */
    public static function managerTransitions(): array
    {
        return collect(self::cases())
            ->filter(fn($case) => !in_array($case, [
                self::DUPLICATE,
                self::SPAM,
                self::CLOSED
            ]))
            ->mapWithKeys(fn($case) => [
                $case->value => $case->label()
            ])
            ->toArray();
    }

    /**
     * Активные статусы (для дашборда)
     */
    public static function activeStatuses(): array
    {
        return [
            self::NEW->value,
            self::ASSIGNED->value,
            self::IN_PROGRESS->value,
        ];
    }

    /**
     * Завершенные статусы
     */
    public static function closedStatuses(): array
    {
        return [
            self::QUALIFIED->value,
            self::REJECTED->value,
            self::DUPLICATE->value,
            self::SPAM->value,
            self::CLOSED->value,
        ];
    }

    /**
     * Получить enum по значению
     */
    public static function fromValue(int $value): ?self
    {
        return collect(self::cases())->first(
            fn($case) => $case->value === $value
        );
    }

    /**
     * Получить все значения для валидации
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
