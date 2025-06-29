   <?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   class ModifyUserIdInKegiatanTable extends Migration
   {
       public function up()
       {
           Schema::table('kegiatan', function (Blueprint $table) {
               $table->unsignedBigInteger('user_id')->nullable()->default(null)->change(); // Mengubah user_id menjadi nullable
           });
       }

       public function down()
       {
           Schema::table('kegiatan', function (Blueprint $table) {
               $table->unsignedBigInteger('user_id')->nullable(false)->change(); // Mengembalikan user_id menjadi tidak nullable
           });
       }
   }
   