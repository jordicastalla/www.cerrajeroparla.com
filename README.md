# Tema «Cerrajeros Parla» — Industrial Gold & Steel

Tema ClassicPress a mida per a **Parla Cerrajeros CP** (cerrajeroparla.com). Substitueix l'antiga base «ClassicPress Theme / Susty». Està fet amb PHP natiu, la jerarquia de plantilles estàndard i CSS vanilla, sense constructors de pàgines, Tailwind ni jQuery al front.

- Telèfon de vendes i urgències: **919 93 26 78** (`tel:+34919932678`). L'única via de conversió és la trucada: no hi ha WhatsApp, formularis ni comentaris.
- Google Maps: https://maps.app.goo.gl/B6aewJE3C5fAn1fb9
- Tipografies: Outfit (títols) i DM Sans (text), carregades des de Google Fonts.
- Requisits: ClassicPress 2.x i PHP 8.0 o superior.

## Fitxers

| Fitxer | Funció |
| --- | --- |
| `style.css` | Capçalera del tema, tokens de color i tipografia, talls diagonals (`clip-path`), targetes d'acer i barra mòbil. |
| `functions.php` | Configuració, càrrega d'assets, neteja d'emojis i del `<head>`, dades del negoci, Schema, divisió del contingut i caixa de les 2 fotos. |
| `header.php` | Capçalera Forge Black, logo tipogràfic amb «CP» daurat, insígnia «Cerrajero libre en Parla» i JSON-LD `Locksmith`. |
| `footer.php` | Banda de crida, serveis, contacte, enllaç a Maps, dades legals mínimes i barra mòbil. |
| `front-page.php` | Portada: hero, els 3 serveis, «Cómo funciona» i zona de servei. |
| `page.php` | Landing «servicio-localidad» amb **exactament 2 buits de foto**. |
| `template-legal.php` | Plantilla «Texto legal (sin fotos)» per a l'avís legal, la privacitat i les cookies. |
| `single.php`, `index.php`, `404.php` | Entrades, arxius i cerca, i la pàgina 404 (amb els serveis). |
| `template-parts/sticky-call.php` | Barra fixa daurada en mòbil: «⚡ LLAMAR: 919 93 26 78». |
| `template-parts/hero.php`, `services-grid.php` | Peces reutilitzades. |
| `js/navigation.js` | Menú mòbil (sense dependències, uns 40 línies). |
| `inc/text-slots.php` | Buits de text per tipus de pàgina: editors clàssics al backend i sortida al front. |
| `js/admin-photos.js` | Selector de la mediateca per a les 2 fotos (només a l'administració). |

## Crear una landing de servei

1. **Títol = H1 = URL**, amb el patró `servicio-localidad`:
   - `Cambio de Cerradura Parla` → `/cambio-de-cerradura-parla/`
   - `Instalación de Cerrojos Parla` → `/instalacion-de-cerrojos-parla/`
   - `Reparación Cierres Metálicos Parla` → `/reparacion-cierres-metalicos-parla/`

   La caixa lateral «Fotos de la landing» comprova el patró (✔/✘) i proposa l'slug correcte.
2. **Extracte**: és el text d'entrada del hero. Si està buit, es mostra un text per defecte amb el telèfon.
3. **Contingut**: insereix l'etiqueta **«Leer más» (`<!--more-->`)** on vulgues que comence el bloc 2, que es mostra al costat de la foto 2. Si no la poses, el tema divideix el text automàticament prop de la meitat, preferint un H2 o H3, i mai no talla dins d'un element.
4. **Fotos**: a la caixa «Fotos de la landing», tria la Foto 1 i la Foto 2. Si la Foto 1 queda buida, s'utilitza la imatge destacada. Mentre falten fotos, el buit es mostra com una placa d'acer reservada, i els editors amb sessió iniciada hi veuen un avís.
   - Alt de la foto 1 = títol de la pàgina. Alt de la foto 2 = «Cerrajeros en Parla 24 horas».
   - Mida `cpc-photo` (1200×900, retallada). Per a imatges pujades abans d'activar el tema, cal regenerar les miniatures (per exemple amb `wp media regenerate`).

Les targetes de la portada, el menú per defecte i el peu enllacen automàticament a aquests tres slugs: si la pàgina existeix, s'usa el seu enllaç permanent.

## Buits de text (Classic Editor)

Sota l'editor principal de cada pàgina hi ha el quadre **«Huecos de texto de la página»**, amb un editor clàssic (TinyMCE, amb «Añadir medios») per cada secció. El **tipus de pàgina** es detecta sol (la Home per la configuració de portada; la resta per l'slug) o es tria al desplegable. Si es canvia el tipus, cal guardar per veure els buits nous.

| Tipus | Buits |
| --- | --- |
| Home | Introducción · 24 horas – Urgencias · Cerrajeros económicos · CTA |
| Instalación de cerraduras y cerrojos | Introducción · Servicio urgente 24 h · Tipos de cerrojos · Alta seguridad y marcas · Según el tipo de puerta · Precios · CTA |
| Cambio de cerradura y bombín | Introducción · Cambiar bombín · Blindadas/acorazadas · Tipos de cerraduras · Económico · CTA |
| Reparación de cierres metálicos | Introducción · Servicio urgente · Tipos de cierres · Motorización · Comercios, garajes y naves · ¿Por qué elegirnos? · CTA |
| Quiénes somos | Introducción · Nuestra historia · Cómo trabajamos hoy · Nuestro compromiso · CTA |

Ordre a la pàgina: buit 1 + foto 1 → buit 2 + foto 2 → la resta de buits → CTA en una targeta negra amb el botó de trucada (s'afegeix sol). A la Home, els serveis i «Cómo funciona» es mantenen entre els buits. Els buits buits no es mostren als visitants; els editors hi veuen un avís. Si cap buit d'una pàgina té text, s'usa l'editor principal com abans.

Els textos es guarden com a metadades `_cpc_text_{buit}` i el tipus com a `_cpc_layout`. Filtre: `cpc_text_layouts`.

## Paraules clau sense canibalització

Els textos fixos del tema canvien segons el tipus de pàgina (`cpc_copy()` a `inc/text-slots.php`): avantítol del hero, entradeta per defecte, insígnia de la capçalera, alt de la foto 2, banda de crida i text del peu. Cada servei només usa la seua paraula clau; «cerrajeros Parla» queda per a la Home, i els altres serveis només apareixen com a text d'enllaç (menú, peu i targetes). Les pàgines sense tipus (textos legals) usen textos neutres. Filtre: `cpc_context_copy`.

## Menús

- **Menú principal**: si no n'assignes cap, es mostren Inici i els 3 serveis.
- **Menú legal (pie de página)**: avís legal, privacitat i cookies. Si no n'assignes cap, es mostra l'enllaç a la política de privacitat.
- La pàgina de privacitat utilitza automàticament la plantilla «Texto legal (sin fotos)». La resta de pàgines legals l'has de triar manualment a «Atributos de página → Plantilla».

## Logo

Ara mateix el logo és tipogràfic («PARLA / CERRAJEROS» + placa daurada «CP»). Quan arribe l'avutarda d'or, puja-la a *Apariencia → Personalizar → Identidad del sitio → Logo*: reemplaça el logo tipogràfic i s'afegeix sola al Schema (`logo` i `image`).

## Dades del negoci

Les constants són al principi de `functions.php`: `CPC_PHONE_DISPLAY`, `CPC_PHONE_TEL`, `CPC_MAPS_URL`, `CPC_BRAND` i `CPC_LOCALITY`. Si canvies una dada, s'actualitza a tot el lloc. Filtres disponibles: `cpc_services`, `cpc_schema_data` i `cpc_front_h1`.

Cada botó de trucada porta l'atribut `data-call="header|hero|cta-band|footer|sticky|…"`, perquè l'analítica pugui distingir d'on ve cada trucada.

## Notes

- **Textos per defecte**: els textos de la portada i els de reserva no inclouen preus, temps d'arribada, garanties ni opinions, perquè no en tenim dades verificades. Si el client en té, s'haurien d'afegir com a contingut real.
- **Google Fonts i RGPD**: les fonts es carreguen des dels servidors de Google, tal com demanava l'encàrrec. A Alemanya, el tribunal LG München I (sentència del 20/01/2022, Az. 3 O 17493/20) va considerar contrari al RGPD transmetre la IP del visitant a Google Fonts sense consentiment. Si es vol evitar aquest risc, es poden allotjar les fonts al mateix servidor.
- **Comentaris i pingbacks**: estan desactivats a tot el lloc (`comments_open` i `pings_open` retornen `false`).
