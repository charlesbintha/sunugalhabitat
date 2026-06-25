<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    public const STATUS_DRAFT = 'draft';

    public const STATUS_VALIDATED = 'validated';

    public const TYPE_SALE = 'vente';

    public const TYPE_RENTAL = 'location';

    public const PROPERTY_STANDARD = 'bien';

    public const PROPERTY_LAND = 'terrain';

    public const LAND_BAIL = 'bail';

    public const LAND_TF = 'tf';

    protected $fillable = [
        'client_id',
        'created_by',
        'invoice_number',
        'title',
        'invoice_type',
        'property_kind',
        'terrain_document_type',
        'amount',
        'issue_date',
        'due_date',
        'notes',
        'is_deposit',
        'apply_discount',
        'discount_rate',
        'status',
        'validated_at',
        'sent_at',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'due_date' => 'date',
            'validated_at' => 'datetime',
            'sent_at' => 'datetime',
            'is_deposit' => 'boolean',
            'apply_discount' => 'boolean',
            'amount' => 'decimal:2',
            'discount_rate' => 'decimal:2',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('created_at')->orderByDesc('id');
    }

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isValidated(): bool
    {
        return $this->status === self::STATUS_VALIDATED;
    }

    public function canBeEdited(): bool
    {
        return $this->isDraft();
    }

    public function subtotalAmount(): float
    {
        return (float) $this->amount;
    }

    public function discountAmount(): float
    {
        if ((float) $this->discount_rate <= 0) {
            return 0.0;
        }

        return round($this->subtotalAmount() * (((float) $this->discount_rate) / 100), 2);
    }

    public function netBeforeVatAmount(): float
    {
        return max(0, round($this->subtotalAmount() - $this->discountAmount(), 2));
    }

    public function vatAmount(): float
    {
        if (! $this->apply_discount) {
            return 0.0;
        }

        return round($this->netBeforeVatAmount() * 0.18, 2);
    }

    public function totalAmount(): float
    {
        return round($this->netBeforeVatAmount() + $this->vatAmount(), 2);
    }

    public function statusLabel(): string
    {
        return $this->isValidated() ? 'Validee' : 'Brouillon';
    }

    public function typeLabel(): string
    {
        return $this->invoice_type === self::TYPE_SALE ? 'Vente' : 'Location';
    }

    public function propertyKindLabel(): string
    {
        return $this->property_kind === self::PROPERTY_LAND ? 'Terrain' : 'Bien immobilier';
    }

    public function terrainDocumentLabel(): ?string
    {
        return match ($this->terrain_document_type) {
            self::LAND_BAIL => 'Bail',
            self::LAND_TF => 'TF',
            default => null,
        };
    }

    public function pdfFilename(): string
    {
        return 'facture-'.strtolower($this->invoice_number).'.pdf';
    }
}
