<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Изменение существующего столбца 'image' на тип binary
            $table->binary('image')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Изменение типа столбца 'image' обратно на string при откате миграции
            $table->string('image')->nullable()->change();
        });
    }
};
