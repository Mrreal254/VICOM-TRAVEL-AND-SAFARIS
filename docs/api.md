# API — Phase 1

Base URL: `/api/v1`

## Authentication

- POST `/auth/register`
- POST `/auth/login`
- POST `/auth/logout`
- GET `/auth/me`

## Public

- GET `/public/settings`
- GET `/public/destinations`
- GET `/public/destinations/featured`
- GET `/public/destinations/{slug}`

## Customer

- GET `/customer/profile`
- PUT `/customer/profile`

## Admin

- GET `/admin/dashboard`
- GET `/admin/users`
- GET `/admin/roles`
- GET `/admin/destinations`
- POST `/admin/destinations`
- GET `/admin/destinations/{id}`
- PUT `/admin/destinations/{id}`
- DELETE `/admin/destinations/{id}`
- GET `/admin/suppliers`
- POST `/admin/suppliers`
- GET `/admin/suppliers/{id}`
- PUT `/admin/suppliers/{id}`
- POST `/admin/suppliers/{id}/verify`
- POST `/admin/suppliers/{id}/reject`
- GET `/admin/settings`
- PUT `/admin/settings`
- GET `/admin/audit-logs`
