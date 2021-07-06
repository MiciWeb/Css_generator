[![forthebadge](https://forthebadge.com/images/badges/built-by-developers.svg)](http://forthebadge.com)
[![forthebadge](https://forthebadge.com/images/badges/not-a-bug-a-feature.svg)](http://forthebadge.com)
[![forthebadge](https://forthebadge.com/images/badges/uses-html.svg)](http://forthebadge.com)


# Css generator
***
### Pré-requis
- css_generator.php
- index.html
- quelques images en .png
## Description du projet
Le but du projet est de développer un programme qui concatène toutes les images passées en argument en une seule (le sprite) et de crée un fichier css associé à cette concaténation.
### Démarrage
Pour faire démarrer le projet il faut ouvrir un terminal et aller dans le dossier du projet puis tapez la commande "php css_generator.php" suivit des paramètres indiqués plus bas.
### Faire fonctionner le projet
Les paramètres suivant la commande "php css_generator.php" sont les options suivit du nom des images ou du dossier images à concaténer.
Il existe plusieurs options pour ce projet:
- l'option -i ou --output-image qui permet de définir le nom de la sprite généré en .png
- l'option -s ou --output-style qui permet de définir le nom du fichier css généré pour la sprite.
- l'option -r ou --recursive qui permet d'indiquer lorsque l'on choisit un dossier de prendre aussi les images des sous-dossiers (il faut ajouter un "/" à la fin du dossier, exemple: php css_generator.php -r img/).

Pour n'afficher qu'une image sur la page "index.html" il faut alors modifier la classe image du fichier html comme ceci "image-(numéro de l'image)".
### Fabriqué avec
* [php](https://php.net) - Language de programmation

### Auteur

* **Micipsa Sersour** _alias_ [@MiciWeb](https://github.com/MiciWeb)
