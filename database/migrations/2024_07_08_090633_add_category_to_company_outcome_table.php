<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryToCompanyOutcomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_outcome', function (Blueprint $table) {
            $table->string('category')->after('jumlah_biaya'); // Tambahkan kolom category setelah kolom jumlah_biaya
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_outcome', function (Blueprint $table) {
            $table->dropColumn('category'); // Hapus kolom category
        });
    }
}
