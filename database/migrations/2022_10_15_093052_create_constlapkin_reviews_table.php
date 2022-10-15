<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = config('shop-reviews.table');
        if (empty($tableName)) {
            throw new \Exception('Error: config/shop-reviews.php not loaded. Run [php artisan config:clear] and try again.');
        }
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('user_id');
            // references('id')->on(app(config('shop-reviews.user_model'))->getTable());
            $table->index('user_id');
            $table->unsignedBigInteger('product_id');
            // references('id')->on(app(config('shop-reviews.relation_model'))->getTable());
            $table->index('product_id');
            $table->text('comment');
            $table->tinyInteger('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableName = config('shop-reviews.table');
        if (empty($tableName)) {
            throw new \Exception('Error: config/shop-reviews.php not loaded. Run [php artisan config:clear] and try again.');
        }
        Schema::dropIfExists($tableName);
    }
};
