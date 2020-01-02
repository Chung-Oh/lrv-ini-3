<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public const TYPE_INDIVIDUAL = 'individual'; // físico
    public const TYPE_LEGAL      = 'legal'; // jurídico
    public const MARITAL_STATUS  = [
        1 => 'Solteiro',
        2 => 'Casado',
        3 => 'Divorciado'
    ];
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'document_number',
        'email',
        'phone',
        'defaulter',
        'date_birth',
        'sex',
        'marital_status',
        'physical_desability',
        'company_name', // nome fantasia
        'client_type',
        'soccer_team_id'
    ];
    public static function getClientType($type)
    {
        return $type == Client::TYPE_LEGAL ? $type : Client::TYPE_INDIVIDUAL;
    }
    /**
     * ---------------------------------------------------------------------------------------
     * RELATIONSHIP
     * ---------------------------------------------------------------------------------------
     */
    public function soccerTeam() // MANY-TO-ONE
    {
        return $this->belongsTo(SoccerTeam::class);
    }

    public function clientProfile()
    {
        return $this->hasOne(ClientProfile::class);
    }
    /**
     * ---------------------------------------------------------------------------------------
     * MUTATORS
     * ---------------------------------------------------------------------------------------
     * Obs: getSexAttribute e getSexFormattedAttribute tem o mesmo fim.
     * Para acessar esse método na View:
     * model->sex
     */
    public function getSexAttribute()
    {
        return $this->attributes['client_type'] == self::TYPE_INDIVIDUAL ? ($this->attributes['sex'] == 'm' ? 'Masculino' : 'Feminino') : '';
    }
    /**
     * Para acessar esse método na View:
     * model->sex_formatted
     */
    // public function getSexFormattedAttribute()
    // {
    //     return $this->client_type == self::TYPE_INDIVIDUAL ? ($this->sex == 'm' ? 'Masculino' : 'Feminino') : '';
    // }
    public function getDateBirthFormattedAttribute()
    {
        return $this->client_type == self::TYPE_INDIVIDUAL ? (new \DateTime($this->date_birth))->format('d/m/Y') : '';
    }
    public function getDocumentNumberFormattedAttribute()
    {
        $document = $this->document_number;
        if (!empty($document)) {
            if (strlen($document) == 11) {
                $document = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $document);
            } elseif (strlen($document) == 14) {
                $document = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $document);
            }
        }
        return $document;
    }
    /**
     * Mutator usado para limpar dados antes da persistência
     */
    public function setDocumentNumberAttribute($value)
    {
        $this->attributes['document_number'] = preg_replace('/[^0-9]/', '', $value);
    }
}
