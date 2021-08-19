<?php
declare( strict_types = 1 );
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() { 

        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 50);
            $table->string('name', 100);
            $table->string('folder', 50);
            $table->string('imagen_prefix', 50);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('books');
    }
}