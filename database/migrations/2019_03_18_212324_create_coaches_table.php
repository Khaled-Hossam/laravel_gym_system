<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
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
        Schema::dropIfExists('coaches');
    }
}
    // php artisan crud:generate Packages --fields='name#string;sessions_number#integer#unsigned;price#integer#unsigned' --form-helper=html
    // --foreign-keys="user_id#id#users"

// php artisan crud:generate Atttendances --fields='session_id#integer#unsigned;user_id#integer#unsigned;'--foreign-keys="session_id#id#sessions;user_id#id#users" --validations "user_id#min:0" --form-helper=html

