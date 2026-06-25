<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->restrictOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('invoice_number')->unique();
            $table->string('title');
            $table->string('invoice_type', 30);
            $table->string('property_kind', 30)->default('bien');
            $table->string('terrain_document_type', 30)->nullable();
            $table->decimal('amount', 15, 2);
            $table->date('issue_date');
            $table->date('due_date')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_deposit')->default(false);
            $table->boolean('apply_discount')->default(false);
            $table->decimal('discount_rate', 5, 2)->default(18);
            $table->string('status', 30)->default('draft');
            $table->timestamp('validated_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
