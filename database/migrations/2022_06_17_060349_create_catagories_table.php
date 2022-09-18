<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
Schema::create('catagories', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('slug')->nullable();
$table->text('description')->nullable();
$table->string('meta_title')->nullable();
$table->string('meta_keyword')->nullable();
$table->string('meta_description')->nullable();
$table->tinyInteger('status')->nullable();
$table->tinyInteger('popular')->nullable();
$table->text('photo')->nullable();
$table->timestamps();
});
}
public function down()
{
Schema::dropIfExists('catagories');
}
};
