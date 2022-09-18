<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
Schema::create('orders', function (Blueprint $table) {
$table->id();
$table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
$table->string('token');
$table->string('date');
$table->tinyInteger('status')->default(0);
$table->float('total');
$table->string('type');
$table->tinyInteger('payment')->default(0);
$table->timestamps();
});
}
public function down()
{
Schema::dropIfExists('orders');
}
};
