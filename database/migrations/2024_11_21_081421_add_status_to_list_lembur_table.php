<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToListLemburTable extends Migration
{
    public function up()
    {
        Schema::table('list_lembur', function (Blueprint $table) {
            $table->string('status')->default('pending');  // Menambahkan kolom status dengan nilai default 'pending'
        });
    }

    public function down()
    {
        Schema::table('list_lembur', function (Blueprint $table) {
            $table->dropColumn('status');  // Menghapus kolom status jika rollback
        });
    }
}
