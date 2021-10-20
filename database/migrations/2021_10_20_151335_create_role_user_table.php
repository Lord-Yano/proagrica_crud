<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();

            /** Two unsigned IDs are required
             *  One links to role user id and the other to user id
             *  They need to be the same column type as the ID on the user and roles table since there is use of foreign keys
             *  The id()helper above uses 8 byte unsignedBigIntergers hence they need to as well 
             */
            // $table->unsignedBigInteger(column: 'role_id'); //ref role id on role table
            // $table->unsignedBigInteger(column: 'user_id'); // ref user id on user table

            //$table->foreignId(column: 'role_id')->constrained()->onDelete(action: 'cascade');
            //$table->foreignId(column: 'user_id')->constrained()->onDelete(action: 'cascade');
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            /** Foreign key constraints for data integrity within database
             *  On delete of user, cascade down the table and delete all instances or roles of that user id
             * */
            //$table->foreign(columns: 'role_id')->references(columns: 'id')->on(table: 'roles')->onDelete(action: 'cascade');
            //$table->foreign(columns: 'user_id')->references(columns: 'id')->on(table: 'users')->onDelete(action: 'cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /** Given a case where foreign keys are to be added at a later point
         *  Use a seperate migration file with foreignIds only
         *  Hence why we are updating this down method to delete these foreign keys
         */

        //    Schema::table('role_user', function(Blueprint $table){
        // drop foreign key relationship | tablename_column_foreignkey
        //            $table->dropForeign(index:'role_user_role_id_foreign');
        //            $table->dropForeign(index:'role_user_user_id_foreign');
        //        }); 
        Schema::dropIfExists('role_user');
    }
}
