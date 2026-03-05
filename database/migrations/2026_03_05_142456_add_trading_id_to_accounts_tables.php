<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('master_accounts', function (Blueprint $table) {
            $table->string('trading_id')->after('customer_id')->nullable();
        });

        Schema::table('slave_accounts', function (Blueprint $table) {
            $table->string('trading_id')->after('master_account_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_accounts', function (Blueprint $table) {
            $table->dropColumn('trading_id');
        });

        Schema::table('slave_accounts', function (Blueprint $table) {
            $table->dropColumn('trading_id');
        });
    }
};
