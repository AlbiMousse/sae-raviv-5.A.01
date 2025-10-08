# Configuration d'un container Discourse

> **Auteur :** Victor Jockin

## Sommaire
[1. Procédures d'installation](#1-procédure-dinstallation)  
[2. Problèmes connus](#2-problèmes-connus)  
&emsp;[2.1. Erreur de "storage driver"](#21-erreur-de-storage-driver)  
&emsp;&emsp;[2.1.1. Description du problème](#211-description-du-problème)  
&emsp;&emsp;[2.1.2. Solution : Autoriser le driver `overlayfs`](#212-solution--autoriser-le-driver-overlayfs)  
&emsp;[2.2. Erreur au moment du Rebuild](#22-erreur-au-moment-du-rebuild)  
&emsp;&emsp;[2.2.1. Description du problème](#221-description-du-problème)  
&emsp;&emsp;[2.2.2. Solution](#222-solution)

## 1. Procédure d'installation

1. Dans le répertoire où a été clôné notre dépôt (`sae-raviv-5.A.01`), clôner le dépôt GitHub officiel `discourse_docker` :
```bash
git clone https://github.com/discourse/discourse_docker.git
```
L'arborescence obtenue doit être la suivante :
```bash
../
├── sae-raviv-5.A.01/
└── discourse_docker/
```

2. Se placer dans le répertoire `discourse_docker` :
```bash
cd discourse_docker
```

3. Dans le répertoire `containers`, copier la configuration `infra/discourse/config/app.yml` hébergée sur notre dépôt :
```bash
cp ../sae-raviv-5.A.01/infra/discourse/config/app.yml containers/app.yml
```

5. Construire le forum Discourse :
```bash
./launcher bootstrap app
```

6. Lancer le forum Discourse :
```bash
./launcher start app
```

## 2. Problèmes connus

### 2.1. Erreur de "storage driver"

#### 2.1.1 Description du problème

Lors de la construction du forum discourse (Étape 5 de la procédure d'installation), l'erreur suivante peut être obtenue :

```bash
Your Docker installation is not using a supported storage driver.
overlay2 is the recommended storage driver, although zfs and aufs may work as well.
Other storage drivers are known to be problematic.
```

Cela signifie que Docker utilise un driver différent de `overlay2` (`overlayfs` par exemple).

Si le driver utilisé est `overlayfs`, suivre la solution 1.

#### 2.1.2. Solution : Autoriser le driver `overlayfs`

1. Ouvrir le fichier `./launcher`.

2. Rechercher un bloc d'instructions similaire à celui ci-dessous :
```shell
if ! $docker_path info 2> /dev/null | grep -E -q 'Storage Driver: (btrfs|aufs|zfs|overlay2)$'; then
  echo "Your Docker installation is not using a supported storage driver.  If we were to proceed you may have a broken install."
  echo "overlay2 is the recommended storage driver, although zfs and aufs may work as well."
  echo "Other storage drivers are known to be problematic."
  echo "You can tell what filesystem you are using by running \"docker info\" and looking at the 'Storage Driver' line."
  echo
  echo "If you wish to continue anyway using your existing unsupported storage driver,"
  echo "read the source code of launcher and figure out how to bypass this check."
  exit 1
fi
```

3. Commenter le bloc :
```shell
#if ! $docker_path info 2> /dev/null | grep -E -q 'Storage Driver: (btrfs|aufs|zfs|overlay2)$'; then
  #echo "Your Docker installation is not using a supported storage driver.  If we were to proceed you may have a broken install."
  #echo "overlay2 is the recommended storage driver, although zfs and aufs may work as well."
  #echo "Other storage drivers are known to be problematic."
  #echo "You can tell what filesystem you are using by running \"docker info\" and looking at the 'Storage Driver' line."
  #echo
  #echo "If you wish to continue anyway using your existing unsupported storage driver,"
  #echo "read the source code of launcher and figure out how to bypass this check."
  #exit 1
#fi
```

4. Relancer la construction du forum Discourse :
```bash
./launcher bootstrap app
```

### 2.2. Erreur au moment du Rebuild

#### 2.2.1. Description du problème

Au moment de l'utilisation de la commande `./launcher rebuild app`, l'erreur suivante peut être obtenue :

```bash
erreur : Vos modifications locales aux fichiers suivants seraient écrasées par la fusion : launcher Veuillez valider ou remiser vos modifications avant la fusion.
Abandon
failed to update
```

Avant d'effectuer un rebuild, le fichier `launcher` se met à jour depuis GitHub. Cependant, Git empêchera la mise à jour si le fichier a été modifié (par exemple pour contourner l'[Erreur de "storage driver"](#21-erreur-de-storage-driver)).

#### 2.2.2. Solution

1. Repérer les fichiers que Git considère comme ayant été modifiés :

```bash
git status
```

2. Sauvegarder les modifications locales :

```bash
git stash push -m "saving updated launcher"
```

3. Mettre à jour le dépôt :

```bash
git pull
```

4. Réappliquer les modifications locales :

```bash
git stash pop
```

5. Valider les modifications locales :

```bash
git add launcher
git commit -m "manual merger of launcher"
```

6. Lancer le rebuild :

```bash
./launcher rebuild app
```

---

BUT Informatique, 3ème Année

IUT de Blagnac,
Université Toulouse II - Jean Jaurès