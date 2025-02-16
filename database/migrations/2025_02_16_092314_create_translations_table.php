<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateTranslationsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('translations', function (Blueprint $table) {

                $table->id();
                $table->string('key_name', 255);
                $table->foreignId('language_id')->constrained('languages')->onDelete('cascade');
                $table->text('content');
                $table->timestamps();
                $table->unique(['key_name', 'language_id']);
            });
        }
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('translations');
        }
    }
?>
