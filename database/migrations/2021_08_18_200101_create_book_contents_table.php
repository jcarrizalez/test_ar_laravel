<?php
declare( strict_types = 1 );
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('book_contents', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('book_id')->using();
            $table->integer('page');
            $table->text('text_content')->nullable();
            $table->string('image');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            #otra manera de crear created_at y updated_at
            #$table->timestamps();

            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            
            $table->unique(['book_id', 'page']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('book_contents');
    }
}