<?php

namespace App\Models;

use App\Enums\NewsCategory;
use App\Enums\NewsStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class NewsUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'status',
        'published_at',
        'is_featured',
        'source_name',
        'source_url',
        'author_id',
    ];

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'category' => NewsCategory::class,
            'status' => NewsStatus::class,
            'published_at' => 'datetime',
            'is_featured' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (NewsUpdate $news): void {
            if (blank($news->slug)) {
                $news->slug = static::uniqueSlug($news->title, $news->id);
            }

            if ($news->status === NewsStatus::Published && $news->published_at === null) {
                $news->published_at = now();
            }
        });
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'kabar';
        $slug = $base;
        $i = 2;

        while (static::query()->where('slug', $slug)->when($ignoreId, fn (Builder $q) => $q->whereKeyNot($ignoreId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /** Published and not scheduled in the future. */
    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', NewsStatus::Published->value)
            ->where('published_at', '<=', now());
    }

    public function scopeLatestPublished(Builder $query): Builder
    {
        return $query->published()->orderByDesc('is_featured')->orderByDesc('published_at');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function summary(): string
    {
        return $this->excerpt ?: Str::limit(strip_tags(Str::markdown($this->content, ['html_input' => 'strip'])), 160);
    }

    /** Only https links are rendered, regardless of what is stored. */
    public function sourceLink(): ?string
    {
        return filled($this->source_url) && str_starts_with($this->source_url, 'https://') ? $this->source_url : null;
    }

    public function contentHtml(): string
    {
        return Str::markdown($this->content, ['html_input' => 'strip', 'allow_unsafe_links' => false]);
    }
}
