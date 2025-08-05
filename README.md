# 📦 Plugin Pterodactyl - Gestionnaire complet de Mods Minecraft

Ce projet apporte au panneau **Pterodactyl** une gestion simple des mods et
modpacks pour serveurs Minecraft.

## 🚀 Fonctionnalités
- Installation et suppression de mods/modpacks
- Redémarrage automatique du serveur après modification
- Interface d'administration et préférences utilisateur
- API REST documentée

## ⚡ Prérequis
- Pterodactyl 1.11+
- PHP 8.1+
- Node.js 18+

## ⚙️ Installation
1. Cloner ce dépôt dans l'arborescence du panel.
2. Installer les dépendances PHP et Node :
   ```bash
   composer install
   npm install
   ```
3. Compiler les assets :
   ```bash
   npm run build
   ```
4. Définir la clé API et les options dans `.env`.

## ⚖️ Compatibilité
- Minecraft Java 1.20+
- Tested with Paper and Forge servers

## 📝 Usage
Après installation, l'interface est disponible dans le panneau admin sous
**Mods Manager**. L'API est exposée sous `/api/mods`.

## 📩 Contribuer
Les contributions sont les bienvenues ! Merci d'ouvrir une *issue* ou une
*pull request* pour discuter des changements.

## 📨 Rapport de bug
Veuillez créer une *issue* avec les logs pertinents.

## 📜 Licence
Distribué sous licence [MIT](./LICENSE).
