<?php

namespace App\Services;

use App\Exceptions\ModNotFoundException;
use App\Exceptions\ModDownloadException;

class ModService
{
    /**
     * Télécharger un mod.
     *
     * @throws ModNotFoundException
     * @throws ModDownloadException
     */
    public function download(string $name): void
    {
        // Exemple d'implémentation: vérifier si le mod existe
        if ($name === '') {
            throw new ModNotFoundException('Mod introuvable.');
        }

        // Simuler un échec de téléchargement
        if ($name === 'fail') {
            throw new ModDownloadException('Échec du téléchargement.');
        }

        // Ici, le téléchargement réel serait effectué
    }

    /**
     * Installer un mod téléchargé.
     *
     * @throws ModNotFoundException
     */
    public function install(string $name): void
    {
        if ($name === '') {
            throw new ModNotFoundException('Mod introuvable.');
        }

        // Installation du mod
    }

    /**
     * Supprimer un mod installé.
     *
     * @throws ModNotFoundException
     */
    public function delete(string $name): void
    {
        if ($name === '') {
            throw new ModNotFoundException('Mod introuvable.');
        }

        // Suppression du mod
    }

    /**
     * Redémarrer le serveur de jeu.
     */
    public function restartServer(): void
    {
        // Dans une application réelle, un appel système serait effectué ici
    }
}

