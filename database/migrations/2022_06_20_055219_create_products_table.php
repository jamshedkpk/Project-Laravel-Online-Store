<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
Schema::create('products', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('slug');
$table->float('original_price');
$table->float('selling_price');
$table->text('description');
$table->float('quantity');
$table->foreignId('catagory_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
$table->tinyInteger('status');
$table->text('photo');
$table->timestamps();
});
}
public function down()
{
Schema::dropIfExists('products');
}
};
