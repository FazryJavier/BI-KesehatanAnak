<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news_updates', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
            $table->string('slug')->nullable()->after('title');
            $table->string('category', 30)->default('announcement')->after('slug');
            $table->string('excerpt', 300)->nullable()->after('category');
            $table->string('status', 20)->default('draft')->after('content');
            $table->timestamp('published_at')->nullable()->after('status');
            $table->boolean('is_featured')->default(false)->after('published_at');
            $table->string('source_name')->nullable()->after('is_featured');
            $table->string('source_url', 2048)->nullable()->after('source_name');
            $table->foreignId('author_id')->nullable()->after('source_url')->constrained('users')->nullOnDelete();
        });

        // Keep any rows created before this migration visible on the site.
        DB::table('news_updates')->orderBy('id')->each(function (object $row): void {
            $title = Str::limit(trim(strtok($row->content, "\n")) ?: 'Kabar #'.$row->id, 80, '');

            DB::table('news_updates')->where('id', $row->id)->update([
                'title' => $title,
                'slug' => Str::slug($title).'-'.$row->id,
                'status' => 'published',
                'published_at' => $row->created_at ?? now(),
            ]);
        });

        Schema::table('news_updates', function (Blueprint $table) {
            $table->string('title')->nullable(false)->change();
            $table->string('slug')->nullable(false)->change();
        });

        Schema::table('news_updates', function (Blueprint $table) {
            $table->unique('slug');
            $table->index(['status', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::table('news_updates', function (Blueprint $table) {
            $table->dropIndex(['status', 'published_at']);
            $table->dropConstrainedForeignId('author_id');
            $table->dropUnique(['slug']);
            $table->dropColumn([
                'title', 'slug', 'category', 'excerpt', 'status',
                'published_at', 'is_featured', 'source_name', 'source_url',
            ]);
        });
    }
};
