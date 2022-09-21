<?php namespace Jozef\Userapi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UsersAddSentCode extends Migration
{

    public function up()
    {
        Schema::table("users", function($table) {
            $table->string("sent_code_at")->nullable();
        });
    }

    public function down() {
        
    }

}