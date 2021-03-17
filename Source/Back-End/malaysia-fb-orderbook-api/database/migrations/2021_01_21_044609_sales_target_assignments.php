<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesTargetAssignments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_target_assignments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->enum('target_month', [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ]);
            $table->string('target_year', 5);
            $table->double('amount', 20, 2);
            $table->timestamps();
            $table->unique(['user_id', 'target_month', 'target_year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_target_assignments');
    }
}
