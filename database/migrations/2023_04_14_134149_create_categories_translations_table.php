    <?php

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
            Schema::create('user_categories_translations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('category_id');
                $table->foreign('category_id')->references('id')->on('user_categories')->onDelete('cascade');
                $table->string('name', 255);
                $table->string('locale')->index();
                $table->unique(['category_id', 'locale']);
                $table->timestamps();
                $table->softDeletes();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('categories_translations', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
            });
            Schema::dropIfExists('categories_translations');
        }
    };
