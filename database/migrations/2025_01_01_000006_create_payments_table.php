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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->foreignId('services_id')->nullable()->constrained('services')->nullOnDelete();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->enum('status', ['Pending', 'Paid', 'Cancelled'])->default('Pending');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
