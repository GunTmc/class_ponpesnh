<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCasteReligionFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek apakah kolom ada sebelum menghapus
            if (Schema::hasColumn('users', 'caste')) {
                $table->dropColumn('caste');
            }
            if (Schema::hasColumn('users', 'religion')) {
                $table->dropColumn('religion');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Untuk rollback jika diperlukan
            $table->string('caste')->nullable();
            $table->string('religion')->nullable();
        });
    }
}
