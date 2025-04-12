# API de Gestion de Stock

Cette API permet de gérer les produits et les mouvements de stock (entrées et sorties) pour un magasin.

## Authentification

- `POST /api/register` - Enregistrement d'un nouvel utilisateur
  - Body: `{ "nom": "string", "email": "string", "password": "string", "password_confirmation": "string" }`

- `POST /api/login` - Connexion
  - Body: `{ "email": "string", "password": "string" }`

- `POST /api/logout` - Déconnexion (nécessite un token)

### Produits

- `GET /api/produits` - Liste des produits
- `POST /api/produits` - Créer un produit
  - Body: `{ "nom": "string", "description": "string", "prix": number }`
- `GET /api/produits/{id}` - Afficher un produit
- `PUT /api/produits/{id}` - Mettre à jour un produit
- `DELETE /api/produits/{id}` - Supprimer un produit (logiquement)

### Entrées

- `GET /api/produits/{produit}/entrees` - Liste des entrées pour un produit
- `POST /api/produits/{produit}/entrees` - Créer une entrée
  - Body: `{ "quantite": number, "date_entree": "YYYY-MM-DD", "commentaire": "string" }`
- `GET /api/produits/{produit}/entrees/{entree}` - Afficher une entrée
- `PUT /api/produits/{produit}/entrees/{entree}` - Mettre à jour une entrée
- `DELETE /api/produits/{produit}/entrees/{entree}` - Supprimer une entrée

### Sorties

- `GET /api/produits/{produit}/sorties` - Liste des sorties pour un produit
- `POST /api/produits/{produit}/sorties` - Créer une sortie
  - Body: `{ "quantite": number, "date_sortie": "YYYY-MM-DD", "raison": "string" }`
- `GET /api/produits/{produit}/sorties/{sortie}` - Afficher une sortie
- `PUT /api/produits/{produit}/sorties/{sortie}` - Mettre à jour une sortie
- `DELETE /api/produits/{produit}/sorties/{sortie}` - Supprimer une sortie

## Utilisation

1. Enregistrez-vous ou connectez-vous pour obtenir un token
2. Ajoutez le token dans les headers des requêtes: `Authorization: Bearer VOTRE_TOKEN`
3. Utilisez les endpoints pour gérer votre stock
