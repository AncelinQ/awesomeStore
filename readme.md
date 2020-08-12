- Nom de domaine : localhost:90 avec serveur Apache sur MAMP

- Plugin : client-message-editor

- Identifiants :
  • administrateur : login : admin password : password
  • client 01 : login : michel password : password
  • client 02 : login : jean password : password

- Page de formulaire : localhost/ananas

-J’ai choisi de créer un theme enfant à Storefront (Storefront Child) afin de conserver les modifications malgré des mises à jours du thème et de ne pas casser le code existant.
Ainsi vous trouverez les modifications de couleur des boutons de la boutique dans le fichier style.css de Storefront-child, ainsi que son appel dans functions.php.
Pour les produits, j’ai voulu approfondir les options en créant 3 catégories (dont une parente, « vêtements », avec 2 enfants, « pantalons » et « t-shirts »).

-J’ai fait également un exercice intermédiaire et un expert.

-Pour le plugin, c’est un texte prédéfini qui s’affiche, modifiable dans le code uniquement. Il s’active et se désactive dans le back office.

-Enfin pour la page de formulaire Ananas, j’ai créé 2 utilisateurs afin de tester différentes possibilités,
Admin et Michel ont un contenu qui s’affiche dans leur compte, modifiable à chaque nouvel envoi du formulaire.
Jean n’ai pas encore rempli le formulaire, donc rien ne s’affiche dans son compte.

La table sql créée est wp_ananas.

Le code se situe dans le theme enfant, dans le fichier page-ananas.php .

Les fonctions créées sont dans le fichier functions.php du theme enfant.

J’espère que cela vous convient, si vous avez des questions, n’hésitez pas à revenir vers moi.

Cordialement,

Ancelin Quinton
