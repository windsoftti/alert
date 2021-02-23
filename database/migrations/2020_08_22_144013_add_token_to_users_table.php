<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\User;
use App\Setting;

class AddTokenToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('pickyassist_token');
        });

        $setting = Setting::where("key", "site.token_picky_assist")->first();

        $user = User::first();
        $user->pickyassist_token=$setting->value;
        $user->save();

        if($setting){
            $setting->delete();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        $setting = new Setting;
        $setting->key = "site.token_picky_assist";
        $setting->display_name = "Token Picky Assist";
        $setting->type = "text";
        $setting->order = 10;
        $setting->group = "Site";
        $setting->save();

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pickyassist_token');
        });
    }
}
