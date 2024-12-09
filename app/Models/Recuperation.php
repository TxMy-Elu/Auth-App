<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recuperation extends Model
{
    protected $table = 'recuperation';
    protected $primaryKey = 'idRecuperation';
    public $timestamps = false;

    public static function existeCode($code) {
        $nb = self::where("codeRecuperation", $code)->count();

        if($nb > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function estValide($code) {
        if(self::existeCode($code) === true) {
            $ligne = self::where("codeRecuperation", $code)->first();
            $dateLimite = new \DateTime($ligne->dateHeureExpirationRecuperation);
            $dateActuelle = new \DateTime("now");

            if($dateActuelle > $dateLimite) {
                return false;
            }
            else {
                return true;
            }
        }
        else {
            return false;
        }
    }

    public static function creerCodeRecuperation($compteUtilisateur) {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($caracteres), 0, 32);

        $nouvelleReactivation = new Recuperation();
        $nouvelleReactivation->codeRecuperation = $code;
        $nouvelleReactivation->idUtilisateur = $compteUtilisateur->idUtilisateur;
        $nouvelleReactivation->save();

        return $code;
    }
}
