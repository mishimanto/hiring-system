<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_seeker_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('professional_title')->nullable();
            $table->text('summary')->nullable();
            $table->string('experience_level')->nullable(); // fresher, junior, mid, senior
            $table->string('preferred_job_title')->nullable();
            $table->string('job_type_preference')->nullable(); // full_time, part_time, remote, hybrid
            $table->string('expected_salary')->nullable();
            $table->string('preferred_location')->nullable();
            $table->string('availability')->nullable(); // immediate, notice_1_month, notice_2_months
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->json('languages')->nullable();
            $table->json('social_links')->nullable(); // {github, linkedin, portfolio}
            $table->integer('profile_completion')->default(0);
            $table->boolean('is_public')->default(true);
            $table->string('portfolio_website')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_seeker_profiles');
    }
};