<?php

namespace Tests\Unit;

use App\Enums\NewsCategory;
use App\Enums\NewsStatus;
use PHPUnit\Framework\TestCase;

class NewsEnumsTest extends TestCase
{
    public function test_every_category_has_label_color_and_tone(): void
    {
        foreach (NewsCategory::cases() as $category) {
            $this->assertNotSame('', $category->getLabel());
            $this->assertNotSame('', $category->getColor());
            $this->assertContains($category->tone(), ['sun', 'sky', 'mint', 'coral']);
        }
    }

    public function test_status_values_match_database_defaults(): void
    {
        $this->assertSame('draft', NewsStatus::Draft->value);
        $this->assertSame('published', NewsStatus::Published->value);
    }

    public function test_unknown_category_is_rejected(): void
    {
        $this->assertNull(NewsCategory::tryFrom('tidak-ada'));
    }
}
