# Documentation de l'API Mods

## Authentification
Toutes les requêtes nécessitent un jeton d'API via l'en-tête `Authorization: Bearer <token>`.

## Endpoints

### GET /api/mods
Liste les mods installés.

**Réponse**
```json
[
  {"name": "WorldEdit", "version": "7.3.0"}
]
```

### POST /api/mods/install
Installe un mod depuis une URL.

**Paramètres**
- `url` *(string)* : lien de téléchargement du mod.

**Réponse**
```json
{"status": "installed"}
```

### POST /api/mods/uninstall
Supprime un mod donné.

**Paramètres**
- `name` *(string)* : nom du mod.

**Réponse**
```json
{"status": "removed"}
```

## Gestion des erreurs
Les erreurs renvoient un code HTTP approprié et un objet :
```json
{"error": "Message d'erreur"}
```
