<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
            'name',      // Assumant que 'name' correspond à 'nom' dans la base de données
            'address',   // Assumant que 'address' correspond à 'adresse' dans la base de données
            'note',      // Colonne pour stocker la note moyenne du restaurant
            'status',    // Colonne pour le statut actuel du restaurant (ex. actif, inactif)
            'created_at' // Colonne pour la date de création de l'enregistrement du restaurant
        ];
}
