
# BDD du projet

## Notes
- Les liaisons sont à sens unique dans le modèle actuel.
- Dernière version 10/09/2026, V1.

-------------------------------------------------------------------------------------------------

## 1. Données utilisateur

### `user`
- `id` (auto)
- `created_at`
- `updated_at`
- `name`
- `first_name`
- `email` (unique)
- `phone`
- `password`
- `roles` (User / Admin)
- `verified` (bool)


-------------------------------------------------------------------------------------------------


## 2. Produits à vendre

### `product`
- `id` (auto)
- `created_at`
- `updated_at`
- `name`
- `category` (guitar, bass, other)
- `images` (json)
- `description`
- `price`
- `stock`
- `is_used` (bool)

### `purchase_product`
- `id` (auto)
- `created_at`
- `price_paid`
- `user_id` ***FK
- `category` (guitar, bass, other)
- `product_id` ***FK


-------------------------------------------------------------------------------------------------


## 3. Packs + leçons + achats + suivi des progrès

### `lesson_pack`
- `id` (auto)
- `created_at`
- `updated_at`
- `instrument` (basse ou guitare)
- `title`
- `description`
- `price`

### `lesson`
- `id` (auto)
- `created_at`
- `updated_at`
- `lesson_pack_id` ***FK
- `title`
- `content`
- `video_url`
- `images`
- `description`
- `price`

### `purchase_lesson`
- `id` (auto)
- `created_at`
- `price_paid`
- `user_id` ***FK
- `purchase_type` (lesson ou pack)
- `lesson_pack_id` (FK ou nullable)
- `lesson_id` (FK ou nullable)

### `progress`
- `id` (auto)
- `created_at`
- `completed_at`
- `user_id` ***FK
- `lesson_id` ***FK
- `is_completed` (bool)



