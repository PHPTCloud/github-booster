<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Enums;

enum ActionsEnum: string
{
    case UNSUBSCRIBE = 'unsubscribe';

    public static function getCasesAsString(string $separator = ', '): string
    {
        return implode($separator, self::getCases());
    }

    public static function getCases(): array
    {
        return array_map(
            static function (ActionsEnum $case): string {
                return $case->value;
            },
            self::cases(),
        );
    }
}
