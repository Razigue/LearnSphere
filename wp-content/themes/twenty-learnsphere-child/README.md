# LearnSphere Twenty Twenty-Five Child

Child theme base sur Twenty Twenty-Five, avec la structure du `theme.json` parent conservee et les valeurs LearnSphere remappees dans les memes slots WordPress.

## Mapping des couleurs

- `base`: `#FBF4E8` - cream, fond principal
- `contrast`: `#282828` - ink, texte principal
- `accent-1`: `#FCED50` - yellow
- `accent-2`: `#FAB25D` - orange
- `accent-3`: `#A2363D` - red
- `accent-4`: `#524C8D` - purple, accent principal interactif
- `accent-5`: `#F2E8D2` - cream muted, surfaces secondaires
- `accent-6`: `color-mix(in srgb, currentColor 20%, transparent)` - bordures

## Typographies

- Corps: `Nunito`
- Titres: `Regime Round`

Nunito utilise les fichiers variables locaux :

- `assets/fonts/Nunito/Nunito-VariableFont_wght.ttf` pour le style normal
- `assets/fonts/Nunito/Nunito-Italic-VariableFont_wght.ttf` pour l'italique

Regime Round utilise les fichiers `RegimeRound-*.woff2` dans `assets/fonts/regime-round`.

## Structure conservee

- 8 couleurs
- 7 espacements
- 5 tailles typo
- 2 familles typo
- 29 definitions de blocs
- 10 definitions d'elements
- 7 template parts
- 1 custom template

## Radius

Les boutons, champs, recherches et petits composants passent a `8px`. Les cartes de preview utilisent `12px`. Les avatars restent ronds.
