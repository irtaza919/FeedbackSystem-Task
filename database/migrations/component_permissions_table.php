<?php

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
                Schema::create("component_permissions", function (Blueprint $table) {
                    $table->id();
                    $table->string("title")->nullable();
                    $table->integer("component_id")->nullable();
                    $table->integer("role_id")->nullable();
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
                Schema::dropIfExists("component_permissions");
            }
        };

        