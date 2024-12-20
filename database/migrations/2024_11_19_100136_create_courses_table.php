<?php  

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  

class CreateCoursesTable extends Migration  
{  
    public function up()  
    {  
        Schema::create('courses', function (Blueprint $table) {  
            $table->id();  
            $table->string('title');  
            $table->text('description');
            $table->foreignId('class_id')->constrained('classmodels')->onDelete('cascade');
            $table->string('category')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();  
        });  
    }  

    public function down()  
    {  
        Schema::dropIfExists('courses');  
    }  
}