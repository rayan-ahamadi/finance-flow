Documentation pour l'API de 
Finance Flow.

Pour démarrer le serveur PHP de l'API : 
 - Naviguer avec la commande cd vers backend/public.
 - Faire la commande "php -S localhost:8000".
 - Les données devront ête envoyés en JSON vers l'API.
 - Et les données retournées sont en format JSON.

Les routes :

  Transaction :

    - "http://localhost:8000/api/transactions/" :
      - méthode GET : Récupère toutes les transactions de la table.
      - méthode POST : Ajoute une transaction pour un user.

    - "http://localhost:8000/api/transactions/user/{user_id}" - méthode GET :
      Récupère toutes les transactions pour un user.

    - "http://localhost:8000/api/transactions/{id_transaction}" : 
      - méthode GET : Récupère une transaction avec son id.
      - méthode PUT : Modifie une transaction avec son id.
      - méthode DELETE : Supprime une transaction.

    Pour le format des données à envoyer en JSON pour 
    modifier ou ajouter une transaction voici un exemple : 
    {
        "type_transaction" : "dépense",
        "amount" : 50,
        "title" : "Courses",
        "date" : "2024-11-14",
        "place" : "Auchan",
        "id_user" : 1,
        "currency_code" : "EUR",
        "currency_symbol" : "€",
        "list_category": [1,9,8] /* 1 étant la catégorie et 9,8 sous-catégories */
    }

    Pour le format qui sera retourné par l'API pour les requêtes GET, voici un exemple :
    {
      "id_transaction": 8,
      "title": "Courses",
      "type_transaction": "dépense",
      "amount": "50.00",
      "date": "2024-11-14",
      "place": "Auchan",
      "currency_code": "EUR",
      "currency_symbol": "€",
      "id_user": 1,
      "list_category": {
        "category": "Alimentation",
        "subcategories": [
          "Viande et poisson",
          "Produits laitiers"
        ]
      }
    } 

  Catégories : 

    - '/api/categories' - méthode GET : récupère toutes les catégories et sous-catégories.
    - '/api/categories/parents' - méthode GET : récupère que les catégories parents.
    - '/api/categories/parents-child/{id}' : Récupère les sous-catégories d'une catégorie parent. 

  Utilisateurs : 

    - '/api/utilisateurs' - Méthode GET : récupère tout les utilisateurs
    - '/api/utilisateurs' - Méthode POST : Ajoute un nouveau utilisateur
