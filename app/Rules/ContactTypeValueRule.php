<?php

namespace App\Rules;

use App\Models\ContactType;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ContactTypeValueRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $parts = explode('.', $attribute);
        $index = (int)$parts[1];

        switch ($index) {
            case 0:
                {
                    if (!(preg_match('/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/', $value))) {
                        $fail('Неправильный формат номера, (Например, +7 (123) 456-78-90)');
                    }
                }
                break;
            case 1:
                {
                    if (!(preg_match('/^(https?:\/\/)?(t\.me\/|telegram\.me\/)?@?[a-zA-Z0-9_]{5,32}$/ui', $value))) {
                        $fail('Неправильный формат аккаунта Telegram, (Например, @durov, t.me/durov)');
                    }
                }
                break;
            case 2:
                {
                    if (!(preg_match('/^(https?:\/\/)?(www\.)?(wa\.me|api\.whatsapp\.com\/send\/?|web\.whatsapp\.com\/send\/?|chat\.whatsapp\.com\/\w+|whatsapp:\/\/)/i', $value))) {
                        $fail('Неправильный формат аккаунта WhatsApp, (Например, www.wa.me/79991234567, whatsapp://send?phone=79991234567)');
                    }
                }
                break;
            case 3:
                {
                    if (!(preg_match('/^(?:https?:\/\/)?(?:www\.)?instagram\.com\/([a-zA-Z0-9_\.]+)\/?(?:\?.*)?$/i', $value))) {
                        $fail('Неправильный формат аккаунта Instagram, (Например, @cristiano)');
                    }
                }
                break;
            case 4:
                {
                    if (!(preg_match('/^(https?:\/\/)?(www\.)?(facebook\.com|fb\.com)\/[a-zA-Z0-9(\.\?)?]/', $value))) {
                        $fail('Неправильный формат аккаунта Facebook, (Например, ://fb.com, https://facebook.com)');
                    }
                }
                break;
            case 5:
                {
                    if (!(preg_match('/^(https?:\/\/)?(www\.)?(twitter\.com|x\.com)\/[a-zA-Z0-9_]{1,15}\/?$/i', $value))) {
                        $fail('Неправильный формат аккаунта Twitter (X), (Например, https://twitter.com, https://x.com)');
                    }
                }
                break;
            case 6:
                {
                    if (!(preg_match('/^https?:\/\/(www\.)?(?:[a-z]{2}\.)?linkedin\.com\/(in|company|profile)\/[a-zA-Z0-9\-_%]+(?:\/)?$/i', $value))) {
                        $fail('Неправильный формат аккаунта LinkedIn , (Например, https://linkedin.com)');
                    }
                }
                break;
            case 7:
                {
                    if (!(preg_match('#^https?://([a-z0-9-]*\.)?(vk\.com|vk\.ru)/(id[0-9]+|[A-Za-z0-9_.()-]+)/?$#ui', $value))) {
                        $fail('Неправильный формат аккаунта VK, (Например, https://vk.com, https://vk.ru)');
                    }
                }
                break;
        }
    }
}
