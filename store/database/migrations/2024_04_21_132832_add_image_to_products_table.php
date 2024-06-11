<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Удаляем столбец 'image', если он уже существует, чтобы избежать конфликтов
            if (Schema::hasColumn('products', 'image')) {
                $table->dropColumn('image');
            }
            // Добавляем новый столбец 'image' с типом binary
            $table->binary('image')->nullable();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
