<?php

use App\Constant\Constant;
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
        Schema::create(Constant::TABLE_DUES, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("users_id");
            $table->string("code",100)->unique()->comment("Format Code : username:UUIDV4");
            $table->date("date");
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign("users_id")->references("id")->on(Constant::TABLE_APP_USER)->cascadeOnDelete();
            $table->foreign("created_by")->references("id")->on(Constant::TABLE_APP_USER)->cascadeOnDelete();
            $table->foreign("updated_by")->references("id")->on(Constant::TABLE_APP_USER)->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Constant::TABLE_DUES);
    }
};
