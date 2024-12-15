<?php

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        // Schema::create('post_tag', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete(); // delets the record if either job or tag associated is deleted
        //     $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        // Schema::dropIfExists('post_tag');
    }
};