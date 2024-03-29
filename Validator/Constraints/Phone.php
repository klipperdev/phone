<?php

/*
 * This file is part of the Klipper package.
 *
 * (c) François Pluchino <francois.pluchino@klipper.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Klipper\Component\Phone\Validator\Constraints;

use libphonenumber\PhoneNumberUtil;
use Symfony\Component\Validator\Constraint;

/**
 * @author François Pluchino <francois.pluchino@klipper.dev>
 *
 * @Annotation
 */
class Phone extends Constraint
{
    public const ANY = 'any';
    public const FIXED_LINE = 'fixed_line';
    public const MOBILE = 'mobile';
    public const PAGER = 'pager';
    public const PERSONAL_NUMBER = 'personal_number';
    public const PREMIUM_RATE = 'premium_rate';
    public const SHARED_COST = 'shared_cost';
    public const TOLL_FREE = 'toll_free';
    public const UAN = 'uan';
    public const VOIP = 'voip';
    public const VOICEMAIL = 'voicemail';

    public ?string $message = null;

    public string $type = self::ANY;

    public string $defaultRegion = PhoneNumberUtil::UNKNOWN_REGION;

    public function getType(): string
    {
        switch ($this->type) {
            case self::FIXED_LINE:
            case self::MOBILE:
            case self::PAGER:
            case self::PERSONAL_NUMBER:
            case self::PREMIUM_RATE:
            case self::SHARED_COST:
            case self::TOLL_FREE:
            case self::UAN:
            case self::VOIP:
            case self::VOICEMAIL:
                return $this->type;
        }

        return self::ANY;
    }

    /**
     * Get the message.
     */
    public function getMessage(): string
    {
        if (null !== $this->message) {
            return $this->message;
        }

        switch ($this->type) {
            case self::FIXED_LINE:
                return 'This value is not a valid fixed-line number.';

            case self::MOBILE:
                return 'This value is not a valid mobile number.';

            case self::PAGER:
                return 'This value is not a valid pager number.';

            case self::PERSONAL_NUMBER:
                return 'This value is not a valid personal number.';

            case self::PREMIUM_RATE:
                return 'This value is not a valid premium-rate number.';

            case self::SHARED_COST:
                return 'This value is not a valid shared-cost number.';

            case self::TOLL_FREE:
                return 'This value is not a valid toll-free number.';

            case self::UAN:
                return 'This value is not a valid UAN.';

            case self::VOIP:
                return 'This value is not a valid VoIP number.';

            case self::VOICEMAIL:
                return 'This value is not a valid voicemail access number.';
        }

        return 'This value is not a valid phone number.';
    }
}
