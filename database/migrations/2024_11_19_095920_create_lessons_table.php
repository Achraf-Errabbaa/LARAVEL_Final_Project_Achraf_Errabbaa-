<?php  

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  

class CreateLessonsTable extends Migration  
{  
    public function up()  
    {  
        Schema::create('lessons', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->integer('duration')->comment('Duration in minutes');
            $table->string('video')->nullable();
            $table->string('pdf')->nullable();
            $table->longText('content');
            $table->timestamps();  
        });  
    }  

    public function down()  
    {  
        Schema::dropIfExists('lessons');  
    }  
}