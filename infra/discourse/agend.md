# Configuration d'un container Discourse

## Procédure d'installation

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

## Problèmes connus

### Erreur de "storage driver"

Lors de la construction du forum discourse (Étape 5 de la procédure d'installation), l'erreur suivante peut être obtenue :

```bash
Your Docker installation is not using a supported storage driver.
overlay2 is the recommended storage driver, although zfs and aufs may work as well.
Other storage drivers are known to be problematic.
```

Cela signifie que Docker utilise un driver différent de `overlay2` (`overlayfs` par exemple).

Si le driver utilisé est `overlayfs`, suivre la solution 1.

**Solution 1 : Autoriser le driver `overlayfs`**

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