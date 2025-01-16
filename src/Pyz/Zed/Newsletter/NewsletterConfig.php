<?php



declare(strict_types = 1);

namespace Pyz\Zed\Newsletter;

use Spryker\Shared\Newsletter\NewsletterConstants;
use Spryker\Zed\Newsletter\NewsletterConfig as SprykerNewsletterConfig;

class NewsletterConfig extends SprykerNewsletterConfig
{
    /**
     * @return array<string>
     */
    public function getNewsletterTypes(): array
    {
        return [
            NewsletterConstants::DEFAULT_NEWSLETTER_TYPE,
        ];
    }
}
