<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
Schema::create('cities', function (Blueprint $table) {
$table->id();
$table->string('name')->nullable();
$table->string('iso2')->nullable();
$table->string('country_iso2')->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
$table->string('state_iso2')->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
$table->timestamps();
});
}

public function down()
{
Schema::dropIfExists('cities');
}
};
