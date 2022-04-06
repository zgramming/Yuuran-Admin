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
        Schema::create(Constant::TABLE_DUES_DETAIL, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger("dues_category_id");
            $table->unsignedInteger("users_id");
            $table->integer("month")->default(0);
            $table->integer("year")->default(0);
            $table->double("amount")->default(0);
            $table->enum("status",['paid_off','not_paid_off','none'])->default('not_paid_off');
            $table->boolean("paid_by_someone_else")->default(false);
            $table->text("description")->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign("dues_category_id")->references("id")->on(Constant::TABLE_DUES_CATEGORY)->cascadeOnDelete();
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
        Schema::dropIfExists(Constant::TABLE_DUES_DETAIL);
    }
};
