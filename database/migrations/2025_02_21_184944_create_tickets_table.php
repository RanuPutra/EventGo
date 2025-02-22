    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('tickets', function (Blueprint $table) {
                $table->id();
                $table->foreignId('acara_id')->constrained('events')->onDelete('cascade');
                $table->enum('tiket', ['VIP' ,'Regular' ,'EarlyBird']);
                $table->integer('harga_tiket');
                $table->integer('max_kapasitas');
                $table->enum('status' ,['Tersedia', 'Habis']);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('tickets');
        }
    };
